<?php

if( strstr( $argv[0], 'php2js' )) {
    main($argv);
}

function assert_cb($file, $line, $message) {
    echo "Assert failed: " . $message . "\n\n";
    debug_print_backtrace();
    exit;
}

function main($argv) {
    ini_set( 'error_reporting', E_ALL | E_STRICT);
    ini_set( 'display_errors', 'on');
    ini_set( 'memory_limit', '-1');
    assert_options( ASSERT_CALLBACK, 'assert_cb');
    
    $include_path = isset( $argv[2] ) ? $argv[2] : '.:' . dirname(__FILE__) . '/../../lib';
    
    $stripper = new stripnamespaces();
    $dom_no_ns = $stripper->stripnamespace_from_xml_file($argv[1]);
    $proc = new Translator( $include_path );
//echo date('c') . "starting translation to JS\n";
    $js_code = $proc->translate_dom( $dom_no_ns, true );
    
    echo "\n" . $js_code . "\n";
}

class stripnamespaces {

    function stripnamespace_from_xml_file($filename) {
        // Crude temporary hack. 
//echo date('c') . " loading file into mem\n";
        $buf = file_get_contents( $filename );
//echo date('c') .  " stripping namespaces\n";
        $buf = preg_replace( '%</([^>]*:)%U', '</', $buf );
        $buf = preg_replace( '/<([^>]*:)/U', '<', $buf );
//echo date('c') . "parsing XML\n";
        $xml = new SimpleXMLElement( $buf );
	return $xml;

        $xml = new DomDocument();
        $xml->loadXML($buf);
        return $xml;
        
        $xml = new DomDocument();
        $xml->load($filename);
        $newdom = $this->stripnamespaces_from_dom( $xml );
        return $newdom;
    }
    
    function stripnamespaces_from_dom( DomDocument &$dom ) {
        $newdom = new DomDocument();
        $this->walk_dom( $dom->firstChild, $newdom, $newdom );
    }

    function walk_dom(DOMNode &$dom_node, DOMDocument $newdoc, DOMNode $newdom) {
        if( $dom_node->node_type == XML_ELEMENT_NODE ) {
            $new_node = $newdoc->createElement( $dom_node->nodeName );
            $newdom->appendChild( $new_node );
            foreach( $dom_node->attributes as $key => $val) {
                $new_node->setAttribute( $key, $val );
            }
        }
        else if( $dom_node->node_type == XML_TEXT_NODE ) {
            $new_node = $newdoc->createTextNode();
        }
        if( !$dom_node->childNodes ) {
            return;
        }
        foreach( $dom_node->childNodes as $child ) {
            $this->walk_dom( $child, $newdoc, $new_node );
        }
    }
}

class func_info {
    var $func_name;
    var $scope_vars = array();
    var $default_args = array();
    
    function __construct( $func_name ) {
        $this->func_name = $func_name;
    }
}

class top_level_func_info {
    var $func_name;
    var $buf_start_token;
    var $buf_len;
    var $call_count = 0;
    
    function __construct( $func_name, $buf_len ) {
        $this->func_name = $func_name;
        $this->buf_start_token = self::gen_start_token( $func_name );
        $this->buf_len = $buf_len;
    }
    
    static function gen_start_token($func_name) {
	return '!#######-########'.$func_name.'#########-######!';
    }
}

class Translator {

    var $xpath;
    var $jsbuf;
    var $pretty = true;
    var $function_scope = array();
    var $include_path;
    var $class_inheritance = array();
    
    static $included_files = array();
    static $defined_top_level_funcs = array();
    
    function __construct( $include_path=null ) {
        // add the global scope to kick things off.
        $this->function_scope[] = new func_info( 'global' );
        
        $this->set_include_path( $include_path );
    }
    
    function set_include_path( $include_path ) {
        $this->include_path = $include_path;
    }

    function translate_xml_file($filename, $optimize = true) {
        $xml = new DomDocument();
        $xml->load($filename);
        return $this->translate_dom( $xml, $optimize );
    }
    
    function translate_dom( SimpleXMLElement $dom, $optimize = true ) {
        
        $this->boilerplate();
        
        $this->walk_dom( $dom );
	
	if( $optimize ) {
	    $this->_optimize();
	}
        
        return $this->jsbuf;
    }
    
    function _optimize() {
	foreach( self::$defined_top_level_funcs as &$func ) {
//	    print_r( $func ); exit;
	    
	    $pos = strpos( $this->jsbuf, $func->buf_start_token );
    	    if( $pos !== null ) {
		$len = false && $func->call_count === 0 ? $func->buf_len + ($this->pretty ? 1 : 0) : strlen( $func->buf_start_token );
		$this->jsbuf = substr_replace( $this->jsbuf, '', $pos, $len );
	    }
	}
    }
    
    function boilerplate() {
        // We only want to print boilerplate once.
        static $first_time = true;
        if( !$first_time ) {
            return;
        }
        $first_time = false;

	// Most Boilerplate code has been moved into core_helpers.js
	// so that it can be optimized away if unused.
        $js_code = "

function ___getall(QueryString) {

	var QS, AllElements, CurElement, CurName, CurVal;

	QS = new Object();

		// Determine the string to use
	if ( !QueryString && typeof location != 'undefined') {
		QueryString = location.search;
	};
        if( !QueryString ) {
            return QS;
        }
		// Split the query string on the ampersand (the substring removes the question mark)
	AllElements = QueryString.substring(1).split('&');

		// Loop over the elements
	for( var Cnt = 0; Cnt < AllElements.length; Cnt++) {
			// Split the current element on the equals sign
		CurElement = AllElements[Cnt].split('=');
		CurName = unescape(CurElement[0]).replace(/^\s*|\s*$/g,'');
			// Call the get method to obtain the value
		if ( CurName.length > 0 ) {
			QS[CurName] = getparam(CurName);
		};
	};

		// Return the object
	return QS;
};
_GET = ___getall();

function ___load_cookies() {
  var cr = {};
  if( typeof document == 'undefined' ) {
    return cr;
  }
  if (document.cookie != '') {
  var ck = document.cookie.split('; ');
  
    for (var i=ck.length - 1; i>= 0; i--) {
      var cv = ck[i].split('=');
      cr[cv[0]]=cv[1];
    }
  }
  return cr;
}
_COOKIE = ___load_cookies();

function Exception(msg, code) {
    this.message = msg && msg.length ? msg : 'Unknown exception';
    this.code = code;
    this.file = null;
    this.line = 0;
    
    this.getMessage = function() {
        return this.message;
    }
    this.getCode = function() {
        return this.code;
    }
    this.getFile = function() {
        return this.file;
    }
    this.getLine = function() {
        return this.line;
    }
    this.getTrace = function() {
        return [];
    }
    this.getTraceAsString = function() {
        return '';
    }
    this.__toString = function() {
        return 'Exception: ' + this.message;
    }
}

        ";
        $this->jsbuf .= $js_code; //str_replace( "\n", ' ', $js_code);
        if( $this->pretty ) {
            $this->jsbuf .= "\n";
        }
	
	$this->_include_file_worker( 'require_once', 'phpjs.php' );
    }

    function walk_dom(SimpleXMLElement $dom_node, $depth = 0) {
        
        $handled = $this->walk_dom_cb( $dom_node , $depth);
        
        $depth ++;
        
        if( !$handled ) {
            foreach( $dom_node->children() as $child_node ) {
                $this->walk_dom( $child_node, $depth );
            }
        }
    }
    
    function walk_dom_cb( SimpleXMLElement $dom_node, $depth ) {
        if( false ) {
            for( $i = 0; $i < $depth; $i++ ) {
                echo "  ";
            }
            echo $dom_node->getName() . "\n";
        }
        
        switch( $dom_node->getName()) {
            case 'Statement_list':
                $this->_statement_list( $dom_node );
                break;
            default:
                return false;
        }
        return true;
    }
    
    function current_scope() {
        return $this->function_scope[count($this->function_scope)-1];
    }

    function _statement_list( $node ) {

        assert( 'is_object($node) && $node->getName() == "Statement_list"' );
        
        foreach( $node->children() as $statement) {
            
            $tmp_buf = $this->jsbuf;
            $this->jsbuf = '';
            $vars_defined_in_scope_before_statement = $this->current_scope()->scope_vars;
            
            $add_terminator = true;
            switch( $statement->getName() ) {
                case 'Class_def':
                    $this->_class_def($statement);
                    $add_terminator = false;
                    break;
                case 'Method':
                    $this->_function($statement);
                    $add_terminator = false;
                    break;
                case 'While':
                    $this->_while($statement);
                    $add_terminator = false;
                    break;
                case 'Do':
                    $this->_do($statement);
                    break;
                case 'For':
                    $this->_for($statement);
                    $add_terminator = false;
                    break;
                case 'Try':
                    $this->_try($statement);
                    $add_terminator = false;
                    break;
                case 'Throw':
                    $this->_throw($statement);
                    break;
                case 'Switch':
                    $this->_switch($statement);
                    $add_terminator = false;
                    break;
                case 'Foreach':
                    $this->_foreach($statement);
                    $add_terminator = false;
                    break;
                case 'Return':
                    $this->_return( $statement );
                    break;
                case 'Break':
                    $this->_break( $statement );
                    break;
                case 'Continue':
                    $this->_continue( $statement );
                    break;
                case 'If':
                    $this->_if( $statement );
                    $add_terminator = false;
                    break;
                case 'Eval_expr':
                    $add_terminator = $this->_eval_expr( $statement );
                    break;
                case 'Global':
                    $this->_global( $statement );
                    $add_terminator = false;
                    break;
                default:
                    $add_terminator = false;
                    break;
            }
            $vars_defined_in_scope_after_statement = $this->current_scope()->scope_vars;
            $newly_defined_vars = array_diff( $vars_defined_in_scope_after_statement, $vars_defined_in_scope_before_statement );
            foreach( $newly_defined_vars as $k => $v ) {
                if( $v === true ) {
                    $tmp_buf .= sprintf( "var %s;\n", $k);
                    // d = already declared.
                    $this->current_scope()->scope_vars[$k] = 'd';
                }
            }
            
            $this->jsbuf = $tmp_buf . $this->jsbuf;
            
            if( $add_terminator ) {
                $this->jsbuf .= ';';
            }
            if( $this->pretty ) {
                $this->jsbuf .= "\n";
            }
        }
    }
    
    function _switch($node) {
        assert( 'is_object($node) && $node->getName() == "Switch"' );
        
        $this->jsbuf .= 'switch(';
        $expr = $this->_xpath_one( $node, 'child::*[2]' );
        $this->_any_expr( $expr );
        $this->jsbuf .= ') {';
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }
        $switch_cases = $this->_xpath_many( $node, 'Switch_case_list/*' );
        foreach( $switch_cases as $s_case ) {
            $this->_switch_case( $s_case );
        }
        $this->jsbuf .= '}';
    }
    
    function _switch_case($node) {
        assert( 'is_object($node) && $node->getName() == "Switch_case"' );
        
        $expr = $this->_xpath_one( $node, 'child::*[2]' );
        if( !count( $expr->children() )) {
            $this->jsbuf .= 'default';
        }
        else {
            $this->jsbuf .= 'case ';
            $this->_any_expr( $expr );
        }
        $this->jsbuf .= ':';
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }
        
        $statement_list = $this->_xpath_one( $node, 'Statement_list' );
        $this->_statement_list( $statement_list );
    }

    function _try($node) {
        assert( 'is_object($node) && $node->getName() == "Try"' );
        
        $statement_list = $this->_xpath_one( $node, 'Statement_list');
        $catch_list = $this->_xpath_one( $node, 'Catch_list');
        
        $this->jsbuf .= 'try{';
        $this->_statement_list( $statement_list );
        $this->jsbuf .= '}';
        
        $this->_catch_list( $catch_list );
    }

    function _catch_list($node) {
        assert( 'is_object($node) && $node->getName() == "Catch_list"' );
        
        $catches = $this->_xpath_many( $node, 'Catch');

        
        foreach( $catches as $catch ) {
            $this->_catch( $catch );
        }
        
    }

    function _catch($node) {
        assert( 'is_object($node) && $node->getName() == "Catch"' );
        
        $class_name = $this->avoid_collision( $this->_get_value( $this->_xpath_one($node, 'CLASS_NAME/value') ) );
        $variable_name = $this->avoid_collision( $this->_get_value( $this->_xpath_one( $node, 'VARIABLE_NAME/value' ) ) );
        $statement_list = $this->_xpath_one( $node, 'Statement_list' );
        
        $this->jsbuf .= sprintf( 'catch(%s if %s instanceof %s) {', $variable_name, $variable_name, $class_name );
        $this->_statement_list( $statement_list );
        $this->jsbuf .= '}';
    }

    function _throw($node) {
        assert( 'is_object($node) && $node->getName() == "Throw"' );
        
        $expr = $this->_xpath_one( $node, 'child::*[2]');
        
        $this->jsbuf .= 'throw ';
        
        $this->_any_expr( $expr );
    }

    function _while($node) {
        assert( 'is_object($node) && $node->getName() == "While"' );
        
        $this->jsbuf .= 'while(';
        $expr = $this->_xpath_one( $node, 'child::*[2]' );
        $this->_any_expr( $expr );
        $this->jsbuf .= ') {';
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }
        $statement_list = $this->_xpath_one( $node, 'Statement_list' );
        $this->_statement_list( $statement_list );
        $this->jsbuf .= '}';
    }
    
    function _global($node) {
        assert( 'is_object($node) && $node->getName() == "Global"' );

        $variables = $this->_xpath_many( $node, 'Variable_name_list/VARIABLE_NAME' );
        foreach( $variables as $var_node ) {
            $var_name = (string)$this->_get_value( $this->_xpath_one( $var_node, 'value') );
            $var_name = $this->avoid_collision( $var_name );
            $this->current_scope()->scope_vars[$var_name] = 'g';
        }
    }
    
    function _class_def( $node ) {
        assert( 'is_object($node) && $node->getName() == "Class_def"' );
        
        $class_name = (string)$this->_get_value( $this->_xpath_one($node, 'CLASS_NAME[1]/value') );
        $class_name_js = $this->avoid_collision( $class_name );
        $parent_name_value = $this->_xpath_one_or_none($node, 'CLASS_NAME[2]/value');
        $parent_name = $parent_name_value ? $this->avoid_collision( $this->_get_value( $parent_name_value ) ) : null;
        
        if( $parent_name ) {
            $this->class_inheritance[$class_name] = (string)$parent_name;
        }

        $constructor = null;
        $has_at_least_one_method = $this->_xpath_one_or_none( $node, "Member_list/Method[1]" );
        if( $has_at_least_one_method ) {
            $constructor_name = $this->_xpath_one_or_none( $node, "Member_list/Method/Signature/METHOD_NAME[value='__construct']" );
            if( !$constructor_name ) {
                // look for php4 style constructor with same name as classname.
                $constructor_name = $this->_xpath_one_or_none( $node, "Member_list/Method/Signature/METHOD_NAME[value='$class_name']" );
            }
            if( $constructor_name ) {
                $constructor = $this->_xpath_one_or_none( $constructor_name, "../.." );
            }
        }
        
        if( $constructor ) {
            $this->_function( $constructor, true );
        }
        else {
            $this->jsbuf .= sprintf( 'function %s() {', $class_name_js );
            $this->_member_list( $this->_xpath_one($node, 'Member_list'), 'this' );
            $this->jsbuf .= '}';
        }
        
        $this->jsbuf .= ' {';
        $this->_member_list( $this->_xpath_one($node, 'Member_list'), 'static' );
        if( $parent_name ) {
            $this->jsbuf .= sprintf( '%s.inheritsFrom( %s );', $class_name_js, $parent_name );
        }
        $this->jsbuf .= sprintf( '} /* end class %s */', $class_name_js );
//        $this->jsbuf .= sprintf("\n%s.prototype.constructor();", $class_name );
    }
    
    function _member_list( $node, $this_or_static ) {
        assert( 'is_object($node) && $node->getName() == "Member_list"' );
        
        $members = $this->_xpath_many( $node, 'child::*');
        
        foreach( $members as $member ) {
            switch( $member->getName() ) {
                case 'Attribute':
                    $this->_attribute( $member, $this_or_static );
                    break;
                case 'Method':
                    $this->_function( $member, false, $this_or_static );
                    break;
                default:
                    throw new Exception( "Unknown expression '$node_name'");
                    break;
            }
        }
    }
    
    function _attribute( $node, $this_or_static ) {
        assert( 'is_object($node) && $node->getName() == "Attribute"' );
        
        $prefix = 'this.';
        $modifiers = $this->_get_attr_mod( $this->_xpath_one($node, 'Attr_mod') );
        $class_name = $this->_get_value( $this->_xpath_one( $node, '../../CLASS_NAME[1]/value') );
        $class_name = $this->avoid_collision( $class_name );
        if( $modifiers['is_static'] || $modifiers['is_const'] ) {
            if( $this_or_static != 'static' ) {
                return;
            }
            
            $prefix = $class_name . '.';
        }
        else {
            if( $this_or_static != 'this' ) {
                return;
            }
        }
        
        $this->_name_with_default_list( $this->_xpath_one( $node, 'Name_with_default_list' ), $prefix, ';' );
    }
    
    function _name_with_default_list( $node, $prepend = '', $postfix = '' ) {
        assert( 'is_object($node) && $node->getName() == "Name_with_default_list"' );
        
        $list = $this->_xpath_many( $node, 'Name_with_default' );
        foreach( $list as $node ) {
            $this->jsbuf .= $prepend;
            $this->_name_with_default( $node );
            $this->jsbuf .= $postfix;
        }
    }
    
    function _name_with_default( $node, $assign_later=false ) {
        assert( 'is_object($node) && $node->getName() == "Name_with_default"' );
        
        $name = (string)$this->_variable_name( $this->_xpath_one($node, 'VARIABLE_NAME') );
        
        $default = $this->_xpath_one($node, 'child::*[3]' );
        // avoid nil
        if( $default->getName() != 'Expr' ) {
            if( $assign_later ) {
                // save the arg assignment for later.
                $expr_node = $this->_xpath_one($node, 'child::*[3]' );
                $this->current_scope()->default_args[$name] = $expr_node;
            }
            else {
                $this->jsbuf .= '=';
                $this->_any_expr( $this->_xpath_one($node, 'child::*[3]' ) );
                $expr_buf = $this->jsbuf;
            }
        }
        
        return $name;
    }
    
    function _variable_name( $node ) {
        assert( 'is_object($node) && $node->getName() == "VARIABLE_NAME"' );
        
        $name = $this->_get_value( $this->_xpath_one( $node, 'value') );
        $name = $this->avoid_collision( $name );
        
        $this->jsbuf .= $name;
        
        return $name;
    }

    function _new( $node ) {
        assert( 'is_object($node) && $node->getName() == "New"' );

//$val = $this->_xpath_many( $node, 'CLASS_NAME/value' );
//if( !$val ) {
//print_r( $node );
//exit;
//}

        $this->jsbuf .= 'new ';

        $reflection = $this->_xpath_one_or_none( $node, 'Reflection' );
        if( $reflection  ) {
            $this->_reflection( $reflection, null );
        }
	else {


            $class_name = $this->_get_value( $this->_xpath_one( $node, 'CLASS_NAME[1]/value' ) );
            $class_name = $this->avoid_collision( $class_name );
        
            $this->jsbuf .= $class_name;
        }
        $parameter_list = $node->xpath( './Actual_parameter_list/Actual_parameter' );
        $count = 0;
        if( count( $parameter_list )) {
            $this->jsbuf .= '(';
        }
        foreach( $parameter_list as $param ) {
            if( $count > 0 ) {
                $this->jsbuf .= ',';
            }
            $this->_callfuncparam( $param );
            $count ++;
        }
        if( count( $parameter_list )) {
            $this->jsbuf .= ')';
        }
    }

    function _instanceof($node) {
        assert( 'is_object($node) && $node->getName() == "Instanceof"' );
        
        $this->_any_expr( $this->_xpath_one( $node, 'child::*[2]') );
        $this->jsbuf .= ' instanceof ';
        $class_name = $this->_get_value( $this->_xpath_one( $node, 'CLASS_NAME/value') );
        $class_name = $this->avoid_collision( $class_name );
        $this->jsbuf .= $class_name;
    }
    
    function _do($node) {
        assert( 'is_object($node) && $node->getName() == "Do"' );
        
        $this->jsbuf .= 'do {';
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }
        $statement_list = $this->_xpath_one( $node, 'Statement_list' );
        $this->_statement_list( $statement_list );
        $this->jsbuf .= '} while (';
        $expr = $this->_xpath_one( $node, 'child::*[3]' );  // Always Bin_op?
        $this->_any_expr( $expr );
        $this->jsbuf .= ')';
    }
    
    function _conditional_expr($node) {
        assert( 'is_object($node) && $node->getName() == "Conditional_expr"' );

        $expr1 = $this->_xpath_one( $node, 'child::*[2]' );
        $expr2 = $this->_xpath_one( $node, 'child::*[3]' );
        $expr3 = $this->_xpath_one( $node, 'child::*[4]' );
        
        $this->jsbuf .= '(';
        $this->_any_expr( $expr1 );
        $this->jsbuf .= '?';
        $this->_any_expr( $expr2 );
        $this->jsbuf .= ':';
        $this->_any_expr( $expr3 );
        $this->jsbuf .= ')';
    }

    function _for($node) {
        assert( 'is_object($node) && $node->getName() == "For"' );
        
        $this->jsbuf .= 'for(';
        $expr1 = $this->_xpath_one( $node, 'child::*[2]' );
        $expr2 = $this->_xpath_one( $node, 'child::*[3]' );
        $expr3 = $this->_xpath_one( $node, 'child::*[4]' );
        
        $this->_any_expr( $expr1 );
        $this->jsbuf .= ";";

        $this->_any_expr( $expr2 );
        $this->jsbuf .= ";";
        
        $this->_any_expr( $expr3 );
        $this->jsbuf .= ') {';
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }
        $statement_list = $this->_xpath_one( $node, 'Statement_list' );
        $this->_statement_list( $statement_list );
        $this->jsbuf .= '}';
    }
    
    function _foreach($node) {
        assert( 'is_object($node) && $node->getName() == "Foreach"' );
        
        $this->jsbuf .= 'for(';
        $expr1 = $this->_xpath_one( $node, 'child::*[2]' );
        $expr2 = $this->_xpath_one( $node, 'child::*[3]' );
        $expr3 = $this->_xpath_one( $node, 'child::*[5]' );

        $before_len = strlen($this->jsbuf);
        $has_key = false;
        $this->jsbuf .= "var ";
        if( $expr2->children() ) {
            $this->_any_expr( $expr2 );
            $has_key = true;
        }
        else {
            $iter_name = '____idx';
            $this->jsbuf .= $iter_name;
        }
        
        $this->jsbuf .= ' in ';
        
        $this->_any_expr( $expr1 );
        $this->jsbuf .= ') {';

        // $this->_any_expr( $expr3 );
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }
        
        // $this->jsbuf .= "var ";
        $this->_variable( $expr3, false, false, true );
        $this->jsbuf .= '=';
        $this->_any_expr( $expr1 );
        $this->jsbuf .= '[';
        if( $has_key ) { $this->_any_expr( $expr2 ); } else { $this->jsbuf .= $iter_name; }
        $this->jsbuf .= "];";
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }
        
        $statement_list = $this->_xpath_one( $node, 'Statement_list' );
        $this->_statement_list( $statement_list );
        $this->jsbuf .= '}';
    }
    
    function _if($node, $is_else = false) {
        assert( 'is_object($node) && $node->getName() == "If"' );
        
        // is_elseif is used for "elseif"
        $is_elseif = $this->_xpath_one_or_none ( $node, "./attrs/attr[@key='phc.unparser.is_elseif'][bool='true']") != null;
        if( !$is_elseif ) {
            // is_wrapped seems to be used for "else if".   they mean the same thing logically.
            $is_elseif = $this->_xpath_one_or_none ( $node, "./attrs/attr[@key='phc.unparser.is_wrapped'][bool='true']") != null;
        }
        
        $name = 'if';
        if( $is_else ) {
            $name = $is_elseif ? 'else if' : 'else';
        }
        
        $this->jsbuf .= $name . '(';
        $expr = $this->_xpath_one( $node, 'child::*[2]' );
        $this->_any_expr( $expr );
        $statement_list = $this->_xpath_one( $node, 'Statement_list[1]' );
        $this->jsbuf .=') {';
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }
        $this->_statement_list( $statement_list );
        $this->jsbuf .= '}';

        $statement_list_else = $this->_xpath_one_or_none( $node, 'Statement_list[2]' );
        if( $statement_list_else != false ) {
            if( $this->pretty ) {
                $this->jsbuf .= "\n";
            }
            
            if( count($statement_list_else->children() )) {
                $if_node = $this->_xpath_one_or_none( $statement_list_else, 'If[1]' );
                $is_elseif = false;
                if( $if_node ) {
                    $is_elseif = $this->_xpath_one_or_none ( $if_node, "./attrs/attr[@key='phc.unparser.is_elseif'][bool='true']") != null;
                }
                if( $is_elseif ) {
                    $this->_if( $if_node, true ); 
                }
                else {
                    $this->jsbuf .= 'else {';
                    if( $this->pretty) {
                        $this->jsbuf .= "\n";
                    }
                    $this->_statement_list( $statement_list_else );
                    $this->jsbuf .= '}';
                }
            }
        }
    }

    function _function($node, $class_constructor=false, $this_or_static = null) {
        
        assert( 'is_object($node) && $node->getName() == "Method"' );

        $function_name = (string)$this->_get_value( $this->_xpath_one( $node, 'Signature/METHOD_NAME/value' ) );
        $parent_node = $this->_xpath_one($node, 'parent::node()');
        $is_class_method = $parent_node->getName() == 'Member_list';
        $modifiers = $this->_get_method_mod( $this->_xpath_one($node, 'Signature/Method_mod') );
	$is_top_level_func = false;
        
        if( $is_class_method ) {
            $class_name = (string)$this->_get_value( $this->_xpath_one($node, '../../child::CLASS_NAME[1]/value') );
            $class_name_js = $this->avoid_collision( $class_name );
            
            $is_constructor = $function_name == '__construct' || $function_name == $class_name;
            if( $is_constructor && !$class_constructor) {
                return false;
            }
        }

        // Add a new variable scope to the stack for this function.
        $this->function_scope[] = new func_info($function_name);
        
//        $name_with_default = $node->xpath( 'Signature[1]//Formal_parameter/Name_with_default/VARIABLE_NAME/value' );
        $name_with_default = $node->xpath( 'Signature[1]//Formal_parameter/Name_with_default' );
        $statements = $this->_xpath_one( $node, 'Statement_list' );
        
        //print_r($arg_names); exit;

        if( $is_class_method ) {
            $display = false;
            if( $is_constructor ) {
                $this->jsbuf .= sprintf("function %s(", $class_name_js);
                $this->_func_args( $name_with_default );
                $this->jsbuf .= ') {';
                $this->_member_list( $this->_xpath_one($node, '..'), 'this' );
            }
            else {
                $class_name = $this->_get_value( $this->_xpath_one($node, '../../child::CLASS_NAME[1]/value') );
                $class_name_js = $this->avoid_collision( $class_name );
                if( $modifiers['is_static'] ) {
                    if( $this_or_static != 'static' ) {
                        return;
                    }
                    $this->jsbuf .= sprintf("%s.%s = function(", $class_name_js, $function_name);
                    $display = true;
                }
                else {
                    if( $this_or_static != 'this' ) {
                        return;
                    }
                    $this->jsbuf .= sprintf("%s.prototype.%s = function(", $class_name_js, $function_name);
                }
                $this->_func_args( $name_with_default );
                $this->jsbuf .= ') {';
            }
        }
        else {
	    $magic_tok = '__php__';
	    if( substr($function_name, 0, strlen($magic_tok) ) == $magic_tok ) {
		// Found the token.  Now we remove it.
		$function_name = substr($function_name, strlen($magic_tok));
	    }
	    
	    if( count($this->function_scope) == 2 ) {
		$is_top_level_func = true;
		$this->jsbuf .= top_level_func_info::gen_start_token( $function_name );
	    }
	    
            $this->jsbuf .= sprintf("%s = function(", $function_name);
            $this->_func_args( $name_with_default );
            $this->jsbuf .= ') {';
        }
        
        if( $this->pretty) {
            $this->jsbuf .= "\n";
        }

        foreach( $this->current_scope()->default_args as $default_arg_name => $default_expr_node ) {
            $this->jsbuf .= sprintf( 'if (typeof %s == "undefined") { %s = ', $default_arg_name, $default_arg_name );
            $this->_any_expr( $default_expr_node );
            $this->jsbuf .= '; }';
            
            if( $this->pretty) {
                $this->jsbuf .= "\n";
            }
        }

        $this->_statement_list( $statements );
        
        array_pop( $this->function_scope );
        
        $this->jsbuf .= "}\n";
	
	if( $is_top_level_func ) {
	    // this is a top level function
	    self::$defined_top_level_funcs[$function_name] = new top_level_func_info($function_name, strlen( $this->jsbuf ) );
	}
    }
    
    function _func_args( $name_with_default ) {
        if( is_array($name_with_default)) {
            $count = 0;
            foreach( $name_with_default as $nwd ) {
                if( $count ++ > 0) {
                    $this->jsbuf .= ',';
                }
                $var_name = (string)$this->_name_with_default( $nwd, true );
                $this->current_scope()->scope_vars[$var_name] = 'a';  // a for arg.
            }
        }
    }
    
    
    function _any_expr( $node ) {
        $node_name = $node->getName();
        
        $add_statement_terminator = true;
        
        if( $node_name == 'Eval_expr') {
            $this->_eval_expr( $node );
        }
        if( $node_name == 'Expr') {
            $this->_expr( $node );
        }
        else if( $node_name == 'Bin_op') {
            $this->_bin_op( $node );
        }
        else if( $node_name == 'Unary_op') {
            $this->_unary_op( $node );
        }
        else if( $node_name == 'Post_op') {
            $this->_post_op( $node );
        }
        else if( $node_name == 'Pre_op') {
            $this->_pre_op( $node );
        }
        else if( $node_name == 'STRING') {
            $this->_string( $node );
        }
        else if( $node_name == 'BOOL') {
            $this->_bool( $node );
        }
        else if( $node_name == 'INT') {
            $this->_int( $node );
        }
        else if( $node_name == 'REAL') {
            $this->_real( $node );
        }
        else if( $node_name == 'NIL') {
            $this->_nil( $node );
        }
        else if( $node_name == 'Cast') {
            $this->_cast( $node );
        }
        else if( $node_name == 'Constant') {
            $this->_constant( $node );
        }
        else if( $node_name == 'Array') {
            $this->_array( $node );
        }
        else if( $node_name == 'Variable') {
            $this->_variable( $node );
        }
        else if( $node_name == 'Method_invocation') {
            $add_statement_terminator = $this->_callfunc( $node );
        }
        else if( $node_name == 'Assignment') {
            $this->_assignment( $node );
        }
        else if( $node_name == 'Op_assignment') {
            $this->_op_assignment( $node );
        }
        else if( $node_name == 'List_assignment') {
            $this->_list_assignment( $node );
        }
        else if( $node_name == 'New') {
            $this->_new( $node );
        }
        else if( $node_name == 'Instanceof') {
            $this->_instanceof( $node );
        }
        else if( $node_name == 'Conditional_expr' ) {
            $this->_conditional_expr( $node );
        }
        else if( $node_name == 'Ignore_errors' ) {
            $this->_ignore_errors( $node );
        }
        else {
            throw new Exception( "Unknown expression '$node_name'");
        }
        
        return $add_statement_terminator;
        
    }

    function _eval_expr($node) {
        assert( 'is_object($node) && $node->getName() == "Eval_expr"' );

        $result = $this->_xpath_one( $node, 'child::*[2]' );
        $type = $result->getName();
        
        switch( $type ) {
            case 'Variable':
                $this->_variable( $result, true );
                break;
            default:
                return $this->_any_expr( $result );
        }
        return true;
    }

    function _expr($node) {
        assert( 'is_object($node) && $node->getName() == "Expr"' );
    }

    function _cast($node) {
        assert( 'is_object($node) && $node->getName() == "Cast"' );
        
        $cast_type = (string)$this->_get_value($this->_xpath_one($node, 'CAST/value'));
        $expr = $this->_xpath_one( $node, './*[3]');
        
        $js_func = null;
        switch($cast_type) {
            case 'int':
                $js_func = 'parseInt';
                break;
            case 'string':
                $js_func = 'String';
                break;
            case 'float':
                $js_func = 'parseFloat';
                break;
        }
        
        if( $js_func) {
            $this->jsbuf .= sprintf( '%s(', $js_func );
        }
        
        $this->_any_expr( $expr );
        
        if( $js_func ) {
            $this->jsbuf .= ')';
        }
    }

    
    function _assignment( $node ) {
        
        assert( 'is_object($node) && $node->getName() == "Assignment"' );
        
        $var_left = $this->_xpath_one( $node, 'Variable[1]');
        $this->_variable( $var_left, false, true );
        $this->jsbuf .= ' = ';
        $expr = $this->_xpath_one( $node, "child::*[4]" );

        $this->_any_expr( $expr );
        
//        $value = $this->_xpath_one( $node, "child::*[4]/attrs/attr[@key='phc.unparser.source_rep']/string" );
//        $this->jsbuf .= sprintf( '%s = %s', $varname, $value );
    }

    function _list_assignment( $node ) {
        
        assert( 'is_object($node) && $node->getName() == "List_assignment"' );
        
        $list_element_list = $this->_xpath_one( $node, 'List_element_list');
        $expr = $this->_xpath_one( $node, "child::*[3]" );
        
        $this->jsbuf .= 'var ____i = 0;';
        $this->jsbuf .= '____tmp = ';
        $this->_any_expr( $expr );
        $this->jsbuf .= ';';

        $this->_list_element_list( $list_element_list );
    }
    
    function _list_element_list( $node ) {
        assert( 'is_object($node) && $node->getName() == "List_element_list"' );
        
        $variables = $this->_xpath_many( $node, 'Variable' );
        
        foreach( $variables as $variable ) {
            $this->_variable( $variable );
            $this->jsbuf .= ' = ____tmp[____i++];';
        }
    }


    function _op_assignment( $node ) {
        
        assert( 'is_object($node) && $node->getName() == "Op_assignment"' );
        
        $var_left = $this->_xpath_one( $node, 'Variable[1]');
        $op = $this->_xpath_one( $node, 'OP');
        $expr = $this->_xpath_one( $node, "child::*[4]" );

        list($var_name, $is_declaration) = $this->_variable( $var_left, false, true );
        $op_str = $this->_get_value($this->_xpath_one($node, 'OP/value'));
        
        if( $is_declaration ) {
            if( $op_str == '.') {
                $this->jsbuf .= sprintf('=prepare_str_concat(%s);%s', $var_name, $var_name );
		$this->_addcallref( 'prepare_str_concat' );
            }
        }
        
        $this->_op( $op );
        $this->jsbuf .= '=';

        $this->_any_expr( $expr );
        
//        $value = $this->_xpath_one( $node, "child::*[4]/attrs/attr[@key='phc.unparser.source_rep']/string" );
//        $this->jsbuf .= sprintf( '%s = %s', $varname, $value );
    }
    
    function _op($node, $nowrite=false) {
        assert( 'is_object($node) && $node->getName() == "OP"' );
        $op_str = $this->_get_value($this->_xpath_one($node, 'value'));

        if( !$nowrite ) {
            $this->_bin_operator( $op_str );
        }
    }

    
    function _return( $node ) {
        
        assert( 'is_object($node) && $node->getName() == "Return"' );
        
        if( count( $this->function_scope ) == 1 ) {
            throw new Exception( "return statement is not supported in the global scope at this time." );
        }
        
        $this->jsbuf .= 'return ';
        $return_item = $this->_xpath_one( $node, './child::*[2]');
        $this->_any_expr( $return_item );
    }

    function _break( $node ) {
        
        assert( 'is_object($node) && $node->getName() == "Break"' );
        
        $this->jsbuf .= 'break';
    }

    function _continue( $node ) {
        
        assert( 'is_object($node) && $node->getName() == "Continue"' );
        
        $this->jsbuf .= 'continue';
    }

    function _ignore_errors( $node ) {
        assert( 'is_object($node) && $node->getName() == "Ignore_errors"' );
        $this->_any_expr( $this->_xpath_one($node, 'child::*[2]' ) );
    }
    
    function _callfunc( $node ) {
        assert( 'is_object($node) && $node->getName() == "Method_invocation"' );
        $call_super = false;
        $class_name = null;
        
        $target = $this->_get_value( $this->_xpath_one( $node, 'child::*[2]' ) );
        $target_is_class = false;
        if( $target->getName() == 'Variable') {
            $this->_variable( $target );
        }
        else if( $target->getName() == 'CLASS_NAME') {
            $class_name = $this->_get_value( $this->_xpath_one($target, 'value' ));
            $my_class_name = null;
            $my_class_node = $this->_xpath_one_or_none($target, 'ancestor::Class_def[1]' );
            if( $my_class_node ) {
                $my_class_name = $this->_get_value( $this->_xpath_one( $my_class_node, 'CLASS_NAME[1]/value' ) );
            }
            if( $class_name == 'self') {
                $class_name = $my_class_name;
                $this->jsbuf .= $this->avoid_collision( $class_name );
            }
            else if( $class_name == 'parent') {
                $call_super = true;
            }
            else {
                $this->jsbuf .= $this->avoid_collision( $class_name );
            }
            $target_is_class = true;
        }
        else if( $target->getName() == 'Method_invocation' ) {
            $this->_callfunc( $target );
        }
        else if( $target->getName() == 'Target' ) {
            // Target is just a placeholder.  do nothing.
        }
        else {
            throw new Exception( sprintf( "Unknown target %s for method invocation", $target->getName() ) );
        }
        
        $need_opening_paren = true;
        $reflection = $this->_xpath_one_or_none( $node, 'Reflection' );
        if( $reflection  ) {
            $this->_reflection( $reflection, $target );
        }
        else {
            $method_name = $this->_get_value( $this->_xpath_one( $node, './METHOD_NAME/value' ) );

            if( !$target ) {
                if( $method_name == 'echo') {
                    $method_name = '___echo';
                }
                // clone is always represented as a method call, whether called as a function or an operator..
                if( $method_name == 'clone') {
                    $method_name = '___clone';
                }

                $include_funcs = array( 'include', 'include_once', 'require', 'require_once');
                if( in_array( $method_name, $include_funcs ) ) {
                    $this->_include_file( $node );
                    return false;
                }
                
                if( $method_name == 'JS' ) {
                    $parameter_list = $node->xpath( './Actual_parameter_list/Actual_parameter' );
                    if( count( $parameter_list ) != 1 ){
                        throw new Exception( sprintf( "native javascript function %s must have one arg", $method_name ) );
                    }
                    $param = $this->_xpath_one( $parameter_list[0], 'child::*[3]' );
                    if( $param->getName() != 'STRING') {
                        throw new Exception( sprintf( "native javascript function %s must have constant arg.  in scope %s", $method_name, $this->function_scope[count($this->function_scope)-1]->func_name ) );
                    }
		    $buf = $this->_stringval( $param );
                    $this->jsbuf .= str_replace( '\$', '$', $buf );
                    return false;
                }

		$this->_addcallref( (string)$method_name );
            }

            
            if( $call_super ) {
                $parent_class = (string)$this->_get_value( $this->_xpath_one_or_none( $node, 'ancestor::Class_def[1]/CLASS_NAME[2]/value' ) );
                if( $parent_class == $method_name || $method_name == '__construct') {
                    $parent_class = $this->avoid_collision( $parent_class );
                    $this->jsbuf .= sprintf('%s.prototype.constructor.call(this', $parent_class);
                }
                else {
                    $this->jsbuf .= sprintf( '%s.prototype.%s.call(this', $parent_class, $method_name );
                }
                $need_opening_paren = false;
            }
            else {
                if( $target ) {
                    $this->jsbuf .= '.';
                }
                if( $method_name == '__construct' || ($class_name && $method_name == $class_name) ) {
                    $this->jsbuf .= 'prototype.constructor.call(this';
                    $need_opening_paren = false;
                }
                else if( $class_name && $my_class_name && $this->class_inherits_from( $my_class_name, $class_name ) ) {
                    $this->jsbuf .= 'prototype.' . $method_name . '.call(this';
                    $need_opening_paren = false;
                }
                else {
                    $this->jsbuf .= $method_name;
                }
            }
        }

        if( $need_opening_paren ) {        
            $this->jsbuf .= '(';
        }
        
        $parameter_list = $node->xpath( './Actual_parameter_list/Actual_parameter' );
        $count = 0;
        foreach( $parameter_list as $param ) {
            if( $count > 0 || !$need_opening_paren ) {
                $this->jsbuf .= ',';
            }
            $this->_callfuncparam( $param );
            $count ++;
        }
        
        $this->jsbuf .= ')';
        
        return true;
    }
    
    function _addcallref( $function_name ) {
	$function_name = (string)$function_name;
	if( isset( self::$defined_top_level_funcs[$function_name] ) ) {
	    self::$defined_top_level_funcs[$function_name]->call_count ++;
	}
    }
    
    function _callfuncparam($node) {
        
        assert( 'is_object($node) && $node->getName() == "Actual_parameter"' );
        
        $param = $this->_xpath_one( $node, 'child::*[3]' );
        $this->_any_expr( $param );
        
//        echo "\n: name: " . $node_name . "\n";
        
    }

    function class_inherits_from( $class, $ancestor ) {
        $class = (string)$class;
        $ancestor = (string)$ancestor;
        while( true ) {
            if( isset( $this->class_inheritance[$class] ) ) {
                $parent = $this->class_inheritance[$class];
                if( $parent == $ancestor ) {
                    return true;
                }
                $class = $parent;
            }
            return false;
        }
    }
    
    function _include_file( $node ) {
        assert( 'is_object($node) && $node->getName() == "Method_invocation"' );
        $method_name = $this->_get_value( $this->_xpath_one( $node, './METHOD_NAME/value' ) );
        $param = $this->_xpath_one( $node, './Actual_parameter_list/Actual_parameter/child::*[3]' );

        if( $param->getName() != 'STRING') {
            throw new Exception( "Only static includes are supported at this time." );
        }
        $parent_node = $this->_xpath_one( $node, 'parent::*[1]' );
        
        $filename = $this->_string( $param, true );
        if( $parent_node->getName() == 'Assignment' ) {
            throw new Exception( sprintf( "Return values from included files are not supported at this time. When including '%s'", $filename ) );
        }
	
	$this->_include_file_worker( $method_name, $filename );
        
    }
    
    function _include_file_worker( $method_name, $filename ) {
        $include_paths = explode( ':', $this->include_path );

        foreach( $include_paths as $include_path ) {
            $filepath = $include_path . DIRECTORY_SEPARATOR . $filename;
            if(file_exists( $filepath)) {
                $filename = $filepath;
                break;
            }
        }
        
        $filename = realpath( $filename );  // normalize path.
        if( strstr( $method_name, '_once' ) && isset( self::$included_files[$filename] ) ) {
            return;
        }
        self::$included_files[$filename] = true;
	
        $parser = new PlatformParser('.', $this->include_path);
        $this->jsbuf .= $parser->compile( $filename, false );
	
    }
    
    function _string( $node, $silent = false ) {
        assert( 'is_object($node) && $node->getName() == "STRING"' );
    
        $str_val = $this->_stringval( $node );
        $doubly_quoted = $this->_xpath_one_or_none( $node, "attrs/attr[@key='phc.unparser.is_doubly_quoted'][bool='true']" ) != null;
        //$str_val = $this->_get_value( $this->_xpath_one( $node, 'value[1]' ));
        if( !$doubly_quoted ) {
            $str_val = str_replace( '\\', '\\\\', $str_val);
            $str_val = str_replace('"', '\"', $str_val);
        }
        $str_val = str_replace( "\n", "\\n", $str_val );  // JS doesn't support multiline strings like PHP does.
        if( !$silent ) {
            $this->jsbuf .= sprintf( '"%s"', $str_val );
        }
        
        return $str_val;
    }
    
    function _stringval( $node ) {
        assert( 'is_object($node) && $node->getName() == "STRING"' );
        
        return $this->_get_value( $this->_xpath_one( $node, "attrs/attr[@key='phc.unparser.source_rep']/string") );
    }
    
    function _int( $node ) {
        assert( 'is_object($node) && $node->getName() == "INT"' );
    
        $str_val = $this->_xpath_one( $node, "attrs/attr[@key='phc.unparser.source_rep']/string");
        $this->jsbuf .= $str_val;
    }
  
    function _bool( $node ) {
        assert( 'is_object($node) && $node->getName() == "BOOL"' );
    
        $str_val = $this->_xpath_one( $node, "attrs/attr[@key='phc.unparser.source_rep']/string");
        $this->jsbuf .= $str_val;
    }

    function _real( $node ) {
        assert( 'is_object($node) && $node->getName() == "REAL"' );
    
        $str_val = $this->_xpath_one( $node, "attrs/attr[@key='phc.unparser.source_rep']/string");
        $this->jsbuf .= $str_val;
    }

    function _nil( $node ) {
        assert( 'is_object($node) && $node->getName() == "NIL"' );
    
        $this->jsbuf .= 'null';
    }

    function _constant( $node ) {
        assert( 'is_object($node) && $node->getName() == "Constant"' );
        
        $class_name_node = $this->_xpath_one_or_none($node, 'CLASS_NAME');
        if( $class_name_node ) {
            $class_name = $this->_get_value( $this->_xpath_one( $class_name_node, 'value' ) );
            
            if( $class_name == 'self' ) {
                // We need to lookup the class'es actual name.
                if( $class_name == 'self') {
                    $class_name = $this->_get_value( $this->_xpath_one($node, 'ancestor::Class_def[1]/CLASS_NAME[1]/value' ));
                    $class_name = $this->avoid_collision( $class_name );
                }
            }
            
            $this->jsbuf .= $class_name . '.';
        }
        $constant_name = $this->_get_value( $this->_xpath_one($node, 'CONSTANT_NAME/value') );
	
	// In case this constant identifies a function.
	$this->_addcallref( (string)$constant_name );
    
        $this->jsbuf .= $constant_name;
    }


    function _array( $node ) {
        assert( 'is_object($node) && $node->getName() == "Array"' );
        
        $this->jsbuf .= '___array(';
	$this->_addcallref( '___array' );
    
        $array_elems = $node->xpath( "Array_elem_list/Array_elem");
        
        $count = 0;
        foreach( $array_elems as $elem ) {
            if( $count++ > 0) {
                $this->jsbuf .= ',';
            }
            $is_assoc = false;
            $elem_key = $this->_xpath_one( $elem, 'child::*[2]' );
            if( $elem_key->getName() == 'Expr') {
            }
            else {
                $this->jsbuf .= '[ "__kv", ';  // kv marks this as a key/val array for the ___array() func's use.
                $is_assoc = true;
                $this->_any_expr( $elem_key );
                $this->jsbuf .= ',';
            }
            $elem_value = $this->_xpath_one( $elem, 'child::*[4]' );            
            $this->_any_expr( $elem_value );
            if( $is_assoc ) {
                $this->jsbuf .= ']';
            }
        }
        
        $this->jsbuf .= ')';
        
    }

    function js_reserved_word($word) {
        static $black_list = array(
     
        // JS 2 reserved words   
        'break',
        'case',
        'catch',
        'continue',
        'default',
        'delete',
        'do',
        'else',
        'false',
        'finally',
        'for',
        'function',
        'if',
        'in',
        'instanceof',
        'new',
        'null',
        'return',
        'switch',
        'this',
        'throw',
        'true',
        'try',
        'typeof',
        'var',
        'void',
        'while',
        'with',
        
        // JS 3 reserved words
        'abstract',
        'boolean',
        'byte',
        'char',
        'class',
        'const',
        'debugger',
        'double',
        'enum',
        'export',
        'extends',
        'final',
        'float',
        'goto',
        'implements',
        'import',
        'int',
        'interface',
        'long',
        'native',
        'package',
        'private',
        'protected',
        'public',
        'short',
        'static',
        'super',
        'synchronized',
        'throws',
        'transient',
        'volatile',
        );
        
        return in_array( $word, $black_list );
    }
    
    function avoid_collision( $word ) {
        $exceptions = array( 'this' );
        return $this->js_reserved_word( $word ) && !in_array( $word, $exceptions ) ? ('_' . $word) : $word;
    }
  
    function _variable( $node, $is_declaration = false, $is_assignment = false, $is_foreach = false ) {
        assert( 'is_object($node) && $node->getName() == "Variable"' );

        $expr_list = $this->_xpath_one_or_none( $node, 'Expr_list');
        
        $var_name_buf = '';
        
        $target = $this->_xpath_one( $node, 'child::*[2]');
        if( $target->getName() == 'Variable' ) {
            list( $vname ) = $this->_variable( $target );
            $var_name_buf .= $vname;  // so we can get the 'this' target
        }
        else if( $target->getName() == 'CLASS_NAME') {
            $class_name = $this->_get_value( $this->_xpath_one($target, 'value' ));
            if( $class_name == 'self') {
                $class_name = $this->_get_value( $this->_xpath_one($target, 'ancestor::Class_def[1]/CLASS_NAME[1]/value' ));
                $class_name = $this->avoid_collision( $class_name );
            }
            else if( $class_name == 'parent') {
                $class_name = 'this.prototype.parent';
            }
            else {
                $class_name = $this->avoid_collision( $class_name );
            }
            $this->jsbuf .= $class_name;
            $var_name_buf .= $class_name;
        }
        else if( $target->getName() == 'Method_invocation') {
            $this->_callfunc( $target );
        }
        else if( $target->getName() == 'Target') {
            // ignore.  Target is just a placeholder.
        }
        else {
            throw new Exception( sprintf( "Unknown variable target '%s'", $target->getName() ) );
        }

        // reflection occurs for variable variables, eg: $$foo
        $reflection = $this->_xpath_one_or_none( $node, 'Reflection' );
        if( $reflection  ) {
            $this->_reflection( $reflection, $target );
        }
        else {
            if( $target ) {
                $this->jsbuf .= '.';
                $var_name_buf .= '.';
            }
            $var_name = (string)$this->_get_value( $this->_xpath_one( $node, './VARIABLE_NAME/value' ) );
            
            $var_name = $this->avoid_collision( $var_name );
            
            if( ($is_assignment || $is_declaration || $is_foreach) && !$target  ) {
                
                if( !isset( $this->current_scope()->scope_vars[$var_name] )) {
                    $is_declaration = true;
                
                    $parent_node = $this->_xpath_one_or_none($node, '../..');
                    if( $parent_node->getName() == 'Eval_expr' || $is_foreach ) {
                        $this->current_scope()->scope_vars[$var_name] = 'y';
                        $this->jsbuf .= 'var ';
                    }
                    else {
                        $this->current_scope()->scope_vars[$var_name] = true;
                    }
                }
            }
            $this->jsbuf .= $var_name;
            $var_name_buf .= $var_name;
        }
        
        if( $expr_list ) {
            
            if( $is_declaration && !$target && count($expr_list) ) {
                $this->jsbuf .= sprintf('=[];%s', $var_name);
            }
            
            $this->_expr_list( $expr_list );
            
            if( substr( $this->jsbuf, strlen($this->jsbuf)-2, 2 ) == '[]' ) {
                $this->jsbuf = substr( $this->jsbuf, 0, strlen($this->jsbuf)-2 );
                $this->jsbuf .= sprintf( '[%s.length]', $var_name_buf );
            }
        }
        
        return array($var_name_buf, $is_declaration);
    }
    
    function _reflection( $node, $target = null ) {
        assert( 'is_object($node) && $node->getName() == "Reflection"' );
/*        
        $parent = $this->_xpath_one( $node, 'parent::node()' );
        if( $parent->getName() == 'New' ) {
            $this->jsbuf .= '(eval(';
            $this->_variable( $this->_xpath_one($node, 'Variable') );
            $this->jsbuf .= '))';
        }
*/       
        if( $target ) {
            $this->jsbuf .= '[eval("';
            $this->_variable( $this->_xpath_one($node, 'Variable') );
            $this->jsbuf .= '")]';
        }
        else {
            $this->jsbuf .= '(eval(';
            $this->_variable( $this->_xpath_one($node, 'Variable') );
            $this->jsbuf .= '))';
            
//            $this->jsbuf .= 'eval(eval("';
//            $this->_variable( $this->_xpath_one($node, 'Variable') );
//            $this->jsbuf .= '"))';
        }
    }

    function _expr_list( $node ) {
        assert( 'is_object($node) && $node->getName() == "Expr_list"' );

        $array_elems = $node->xpath( "child::*");
        if( !count( $array_elems )) {
            return;
        }
        
        $this->jsbuf .= '[';

        $count = 0;
        foreach( $array_elems as $elem ) {
            if( $count++ > 0) {
                $this->jsbuf .= '][';
            }
            $this->_any_expr( $elem);
        }
        
        $this->jsbuf .= ']';
    }

    
    function _bin_op( $node ) {
        assert( 'is_object($node) && $node->getName() == "Bin_op"' );
        
        $operand1 = $this->_xpath_one( $node, 'child::*[2]');
        $operator = $this->_get_value( $this->_xpath_one( $node, 'OP/value[1]') );
        $operand2 = $this->_xpath_one( $node, 'child::*[4]');
        
        $add_parens = $this->_xpath_one_or_none( $node, "./attrs/attr[@key='phc.unparser.needs_user_brackets'][bool='true']" ) != null;
        if( $add_parens ) {
            $this->jsbuf .= '(';
        }
        
        $this->_bin_operand( $operand1 );
        $this->_bin_operator( $operator );
        $this->_bin_operand( $operand2 );
        
        if( $add_parens ) {
            $this->jsbuf .= ')';
        }
    }
    
    function _pre_op( $node ) {
        
        assert( 'is_object($node) && $node->getName() == "Pre_op"' );

        $operand = $this->_xpath_one( $node, 'Variable');
        $operator = $this->_get_value( $this->_xpath_one( $node, 'OP/value[1]') );

        $this->_bin_operator( $operator );
        $this->_bin_operand( $operand );
    }

    function _post_op( $node ) {
        
        assert( 'is_object($node) && $node->getName() == "Post_op"' );

        $operand = $this->_xpath_one( $node, 'Variable');
        $operator = $this->_get_value( $this->_xpath_one( $node, 'OP/value[1]') );

        $this->_bin_operand( $operand );
        $this->_bin_operator( $operator );
    }


    function _unary_op( $node ) {
        assert( 'is_object($node) && $node->getName() == "Unary_op"' );
        
        $operator = $this->_get_value( $this->_xpath_one( $node, 'OP/value[1]') );
        $operand = $this->_xpath_one( $node, 'child::*[3]');
        
        $add_parens = $this->_xpath_one_or_none( $node, "./attrs/attr[@key='phc.unparser.needs_user_brackets'][bool='true']" ) != null;
        if( $add_parens ) {
            $this->jsbuf .= '(';
        }
        
        $this->_bin_operator( $operator );
        $this->_bin_operand( $operand );
        
        if( $add_parens ) {
            $this->jsbuf .= ')';
        }
    }
    
    function _get_attr_mod( $node ) {
        assert( 'is_object($node) && $node->getName() == "Attr_mod"' );
        
        return array(
            'is_public'     => (string)$this->_xpath_one($node, './bool[1]') == 'true',
            'is_protected'  => (string)$this->_xpath_one($node, './bool[2]') == 'true',
            'is_private'    => (string)$this->_xpath_one($node, './bool[3]') == 'true',
            'is_static'     => (string)$this->_xpath_one($node, './bool[4]') == 'true',
            'is_const'      => (string)$this->_xpath_one($node, './bool[5]') == 'true',
        );
    }

    function _get_method_mod( $node ) {
        assert( 'is_object($node) && $node->getName() == "Method_mod"' );
        
        return array(
            'is_public'     => (string)$this->_xpath_one($node, './bool[1]') == 'true',
            'is_protected'  => (string)$this->_xpath_one($node, './bool[2]') == 'true',
            'is_private'    => (string)$this->_xpath_one($node, './bool[3]') == 'true',
            'is_static'     => (string)$this->_xpath_one($node, './bool[4]') == 'true',
            'is_abstract'   => (string)$this->_xpath_one($node, './bool[5]') == 'true',
            'is_final'      => (string)$this->_xpath_one($node, './bool[6]') == 'true',
        );
    }
    
    function _get_value( SimpleXMLElement $node ) {
        $encoding = $this->_xpath_one_or_none( $node, "attribute::encoding" );

        $val_str = $node;
        if( $encoding == 'base64' ) {
            $val_str = base64_decode( $val_str);
        }
        return $val_str;
    }
    
    function _value( $node ) {
        $this->jsbuf .= $this->_get_value( $node );
    }
    
    function _bin_operand( $node ) {
        $this->_any_expr( $node );
    }
    
    function _bin_operator( $op_str ) {
        switch( $op_str ) {
            case 'or':  $op = '||';    break;
            case 'and': $op = '&&';    break;
            case '.':   $op = '+';     break;
            case '<>':  $op = '!=';    break;
            default:    $op = $op_str; break;
        }
        $this->jsbuf .= $op;
    }
    
    function _xpath_one( $node, $query ) {
        $result = $node->xpath( $query );
        if( $result === false ) {
            throw new Exception( sprintf( "xpath query invalid on node %s.  query: %s", $node->getName(), $query ));
        }
        if( count( $result) != 1) {
            throw new Exception( sprintf( "xpath query returned %d results on node %s.  expected 1 result. query: %s", count($result), $node->getName(), $query ));
        }
        return $result[0];
    }

    function _xpath_one_or_none( $node, $query ) {

        $result = @$node->xpath( $query );
        if( $result === false ) {
            throw new Exception( sprintf( "xpath query invalid on node %s.  query: %s", $node->getName(), $query ));
        }
        if( count( $result) > 1) {
            throw new Exception( sprintf( "xpath query returned %d results on node %s.  expected 0 or 1 results. query: %s", count($result), $node->getName(), $query ));
        }
        return count($result) ? $result[0] : null;
    }
    
    function _xpath_many( $node, $query ) {

        $result = @$node->xpath( $query );
        if( $result === false ) {
            throw new Exception( sprintf( "xpath query invalid on node %s.  query: %s", $node->getName(), $query ));
        }
        return $result;
    }

}



class PlatformParser {
    function __construct($platform_dir = "", $include_path = null) {
        $this->platform_dir = $platform_dir;
        $this->parse_cache = array();
        $this->platform = "";
        $this->include_path = $include_path;
    }

    function setPlatform($platform) {
        $this->platform = platform;
    }
    
    function compile( $filename, $optimize = true ) {
        
            $xml_file = $filename . '.xml';
            $cmd = sprintf( 'phc --dump-xml=ast %s >  %s', escapeshellarg( $filename ), escapeshellarg($xml_file) );

            passthru( $cmd, $rc );
            if( $rc != 0 ) {
                die( "this command failed: $cmd\n");
            }
        
            $stripper = new stripnamespaces();
            $dom_no_ns = $stripper->stripnamespace_from_xml_file($xml_file);
            unlink( $xml_file );
            $proc = new Translator( $this->include_path );
            return $proc->translate_dom( $dom_no_ns, $optimize );
    }
    
    function parseModule($module_name, $file_name) {
        if( isset( $this->parse_cache[$file_name] ) ) {
            $mod = $this->parse_cache[$file_name];
        }
        else {
            print "Importing " . $module_name;
            
            $mod = $this->compile($file_name);
            $this->parse_cache[$file_name] = $mod;
        }
        
        $platform_file_name = $this->generatePlatformFilename($file_name);
        if( $this->platform && file_exists($platform_file_name) ) {

            $mod_override = $this->compile( $platform_file_name );
            $this->merge($mod, $mod_override);
        }

        return $mod;
    }
        
    function generatePlatformFilename($file_name) {
        list($dirname, $module_name, $extension) = pathinfo($file_name);
        $platform_file_name = $module_name + $this->platform + $extension;
        
        return $dirname . DIRECTORY_SEPARATOR . $this->platform_dir . DIRECTORY_SEPARATOR . $platform_file_name;
    }
/*
    function merge(tree1, tree2):
        for child in tree2.node:
            if isinstance(child, ast.Function):
                $this->replaceFunction(tree1, child.name, child)
            elif isinstance(child, ast.Class):
                $this->replaceClassMethods(tree1, child.name, child)

        return tree1
            
    function replaceFunction(tree, function_name, function_node):
        # find function to replace
        for child in tree.node:
            if isinstance(child, ast.Function) and child.name == function_name:
                $this->copyFunction(child, function_node)
                return
        raise TranslationError("function not found: " + function_name, function_node)

    function replaceClassMethods(tree, class_name, class_node):
        # find class to replace
        old_class_node = None
        for child in tree.node:
            if isinstance(child, ast.Class) and child.name == class_name:
                old_class_node = child
                break
        
        if not old_class_node:
            raise TranslationError("class not found: " + class_name, class_node)
        
        # replace methods
        for function_node in class_node.code:
            if isinstance(function_node, ast.Function):
                found = False
                for child in old_class_node.code:
                    if isinstance(child, ast.Function) and child.name == function_node.name:
                        found = True
                        $this->copyFunction(child, function_node)
                        break

                if not found:
                    raise TranslationError("class method not found: " + class_name + "." + function_node.name, function_node)
*/
    function copyFunction($target, $source) {
        $target->code = $source->code;
        $target->argnames = $source->argnames;
        $target->defaults = $source->defaults;
        $target->doc = $source->doc; // @@@ not sure we need to do this any more
    }
}

class AppTranslator {

    function __construct($library_dirs=array("../library"), $parser=null) {
        $this->extension = ".php";

        $this->library_modules = array();
        $this->library_dirs = $library_dirs;
        
        if( !$parser ) {
            $this->parser = new PlatformParser();
        }
        else {
            $this->parser = $parser;
        }
    }

    function findFile($file_name) {
        if( file_exists($file_name) ) {
            return $file_name;
        }

//        if( $file_name[:8] == 'pyjamas.' ) { //  # strip off library name
        if( substr($file_name, 0, 8) == 'pyjamas.' ) { //  # strip off library name
            if( $file_name != "pyjamas.py" ) {
                $file_name = substr( $file_name, 8 );
            }
        }
        foreach( $this->library_dirs as $library_dir ) {
            $full_file_name = dirname(__FILE__) . DIRECTORY_SEPARATOR . $library_dir . DIRECTORY_SEPARATOR . $file_name;
            if(file_exists($full_file_name)) {
                return $full_file_name;
            }
        }
        
        throw new Exception("file not found: " . $file_name);
    }
    
    function translate($module_name, $is_app=True) {

        if( !in_array( $module_name, $this->library_modules ) ) {
            $this->library_modules[] = $module_name;
        }
        
        $file_name = $this->findFile($module_name . $this->extension);
        
        if($is_app) {
            $module_name_translated = "";
        }
        else {
            $module_name_translated = $module_name;
        }
        
        $output = '';
        
        $mod = $this->parser->parseModule($module_name, $file_name);
        return $mod;
    
        $t = new Translator($module_name_translated, $mod, $output);
        $module_str = $output->getvalue();
        
        $imported_modules_str = "";
        foreach( $t->imported_modules as $module ) {
            if( !in_array( $module, $this->library_modules ) ) {
                $imported_modules_str .= $this->translate(module, $false);
            }
        }
        foreach( $t->imported_js as $js ) {
           $path = $this->findFile($js);
           if( file_exists($path) ) {
              print 'Including ' .  js;
              $imported_modules_str .= '\n//\n// BEGIN '.js.'\n//\n';
              $imported_modules_str .= file_get_contents($path);
              $imported_modules_str .= '\n//\n// END '.js.'\n//\n';
           }
           else {
              fprintf( STDERR, 'Warning: Unable to find imported javascript: ' . js );
           }
        }
           
        if( $module_name == 'pyjamas' ) {
            return $imported_modules_str ;
        }
        return $imported_modules_str + $module_str;
    }

    function translateLibraries($library_modules=array()) {
        $this->library_modules = $library_modules;

        $imported_modules_str = "";
        foreach( $this->library_modules as $library ) {
            $imported_modules_str .= $this->translate($library, false);
        }
        
        return $imported_modules_str;
    }

}

?>
