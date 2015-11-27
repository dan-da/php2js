<?php

main($argv);

function assert_cb($file, $line, $message) {
    echo "Assert failed: " . $message . "\n\n";
    debug_print_backtrace();
    exit;
}


function main($argv) {
    ini_set( 'error_reporting', E_ALL | E_STRICT);
    ini_set( 'display_errors', 'on');
    assert_options( ASSERT_CALLBACK, 'assert_cb');
    
    $proc = new phpjs();
    $proc->translate_file( $argv[1] );
}


class phpjs {

    var $dom;
    var $curnode;
    var $pretty = true;
    var $need_closing_paren = 0;
    var $in_quoted_string = false;
    var $local_scope = array();
    var $context = array('global');
    
    function __construct() {
        $this->local_scope[] = array();  // the global scope.
    }

    function translate_file($filename) {
        $buf = file_get_contents( $filename );
        return $this->translate( $buf );
    }
    
    function translate( $code_buf ) {
        
        $tokens = token_get_all( $code_buf );
//        $this->_print_tokens( $tokens );
        $this->dom = new SimpleXMLElement('<PHP_script/>', null, false, 'foobar', false);
        $this->curnode = $this->dom;
        $this->_translate( $tokens );
        
        
        $doc = new DOMDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->loadXML($this->dom->asXML());
        $doc->formatOutput = true;
        echo "\n" . $doc->saveXML() . "\n";
    }
    
    
    function _print_tokens( $tokens ) {
        foreach( $tokens as $token ) {
            if(is_array($token))
            {
                print(token_name($token[0]) . ": '" . $token[1] . "'\n");
            }
            else if( is_long( $token )) {
                echo token_name( $token ) . "\n";
            }
            else {
                echo $token . "\n";
            }
        }
    }
    
    function _translate( $tokens ) {
        $this->tokens = $tokens;
        $this->idx_current_token = 0;
        $this->in_quoted_string = false;

        $this->curnode->addChild('attrs');
        $this->begin_statement_list();

        for( $this->idx_current_token = 0; $this->idx_current_token < count( $this->tokens ); $this->idx_current_token ++) {
            $token = $this->tokens[$this->idx_current_token];
            if(is_array($token))
            {
                $token_name = token_name($token[0]);
                $token_value = $token[1];
            }
            else if( is_long( $token )) {
                $token_name = token_name( $token );
            }
            else {
                $token_name = $token;
                $token_value = $token;
            }
            $method_name = strtolower($token_name);

            if( strlen( $method_name) == 1) {
                $this->handle_char( $method_name );
            }
            else if( method_exists($this, $method_name )) {
                $token[2] = token_name( $token[0] );
                $this->$method_name( $token );
            }
            else {
                $this->jsbuf .= $token_value;
            }
            
        }
    }

    function context($depth) {
        $idx = count($this->context) - 1 - $depth;
        if( $idx > -1 ) {
            return $this->context[$idx];
        }
        return null;
    }

    function get_token( $token ) {
        $token_name = null;
        if(is_array($token))
        {
            return array(token_name($token[0]), $token[1]);
        }
        else {
            return array( $token, $token );
        }
    }
    
    function get_token_by_idx( $idx ) {
        return $this->get_token( $this->tokens[$idx] );
    }
    
    function get_token_name( $token ) {
        $tok = $this->get_token( $token );
        return $tok[0];
    }

    function get_token_value( $token ) {
        $tok = $this->get_token( $token );
        return $tok[1];
    }

    function get_token_name_by_idx( $idx ) {
        return $this->get_token_name( $this->tokens[$idx] );
    }

    function get_token_value_by_idx( $idx ) {
        return $this->get_token_value( $this->tokens[$idx] );
    }
    
    function t_echo( $token ) {
        $this->_eval_expr();
        $this->_method_invocation('echo');
    }
    
    function t_open_tag( $token ) { 
    }

    function t_close_tag( $token ) { 
    }

    function t_whitespace( $token ) {
        if( $this->pretty ) {
//            $this->jsbuf .= $token[1];
        }
    }
    
    function t_array( $token ) {
        $this->context[] = $token[0];
        
        $this->jsbuf .= '___array(';
        $this->array_brace_count ++;
    }
    
    function t_variable( $token, $is_decl = null ) {
        if( $this->in_quoted_string ) {
            $this->jsbuf .= '"+';
        }
        $var_name = str_replace( '$', '', $token[1] );

        if( $is_decl === null ) {
            $prev_id = $this->consume_whitespace_reverse( $this->idx_current_token -1 );
            $prev_name = $this->get_token_name_by_idx( $prev_id );
            if( in_array($prev_name, array('{',')', '}', ';') ) ) {
                $next_id = $this->consume_whitespace( $this->idx_current_token +1 );
                $next_name = $this->get_token_name_by_idx( $next_id );
                if( $next_name == ';' || $next_name == '=') {
                    $is_decl = true;
                }
            }
        }

        if( $is_decl) {
            $scope_idx = count($this->local_scope)-1;
            $declared_in_scope = false;
            
            do {
                if( isset( $this->local_scope[$scope_idx][$var_name])) {
                    $declared_in_scope = true;
                    break;
                }
                if( isset($this->local_scope[$scope_idx]['___scope_func'])) {
                    break;
                }
            } while ( --$scope_idx > 0 );
            if( !$declared_in_scope ) {
                if( !$this->in_function_decl() ) {
                    $this->jsbuf .= 'var ';
                }
                $this->local_scope[count($this->local_scope)-1][$var_name] = 1;
            }
            
        }
        
//            echo $var_name . "\n";
//            print_r( $this->local_scope );
//            echo "\n";

        $this->jsbuf .= $var_name;
        if( $this->in_quoted_string ) {
            $this->jsbuf .= '+"';
        }
    }

    function in_function_decl() {
        return $this->context(0) == '(' && $this->context(1) == 'function';
    }
    
    function t_function( $token ) {
        $this->context[] = $token[1];
        $this->jsbuf .= 'function';
    }

    function t_while( $token ) {
        $this->context[] = $token[1];
        $this->jsbuf .= $token[1];
    }

    function t_if( $token ) {
        $this->context[] = $token[1];
        $this->jsbuf .= $token[1];
    }

    function t_elseif( $token ) {
        $this->context[] = $token[1];
        $this->jsbuf .= 'else if';
    }
    
    function t_else( $token ) {
        $this->context[] = $token[1];
        $this->jsbuf .= $token[1];
    }
    
    function t_for( $token ) {
        $this->context[] = $token[1];
        $this->jsbuf .= $token[1];
    }
    
    function t_switch( $token ) {
        $this->context[] = $token[1];
        $this->jsbuf .= $token[1];
    }
    
    function t_do( $token ) {
        $this->context[] = $token[1];
        $this->jsbuf .= $token[1];
    }
    
    // foreach( $foo as $key => val)
    function t_foreach( $token ) {
        $this->context[] = $token[1];
        
/*        
        for( $i = 0; $i < 20; $i ++ ) {
            echo sprintf("i = $i, name=%s, value=%s\n", $this->get_token_name_by_idx($this->idx_current_token+$i), $this->get_token_value_by_idx($this->idx_current_token+$i));
        }
*/
            // advance to opening paren
            $idx = $this->consume_whitespace( $this->idx_current_token + 1 );
            
            // advance to variable
            $idx = $this->consume_whitespace( $idx + 1 );
            
            $arr = $this->get_token_value_by_idx( $idx );
            
            // advance to 'as'
            $idx = $this->consume_whitespace( $idx + 1 );
            
            // advance to key (or val)
            $idx = $this->consume_whitespace( $idx + 1 );
            
            $key_or_val = $this->get_token_value_by_idx( $idx );
            
            // advance to closing paren (or =>)
            $idx = $this->consume_whitespace( $idx + 1 );
            
            $paren_or_double_arrow = $this->get_token_name_by_idx( $idx );
            
            $is_assoc = $paren_or_double_arrow == 'T_DOUBLE_ARROW';
            if( $is_assoc ) {
                $key = $key_or_val;
                
                // advance to value
                $idx = $this->consume_whitespace( $idx + 1 );
                $value = $this->get_token_value_by_idx( $idx );
                
                // advance to closing paren
                $idx = $this->consume_whitespace( $idx + 1 );
            }
            else {
                $key = '___key';
                $value = $key_or_val;
            }

            $key = str_replace( '$', '',$key);
            $value = str_replace( '$', '', $value);
            $arr = str_replace( '$', '', $arr);
            $this->jsbuf .= 'for(';
            $this->t_variable( array( T_VARIABLE, $key), true);
            $this->jsbuf .= sprintf( ' in %s)', $arr );
            $this->handle_char( '{');
            $this->t_variable( array( T_VARIABLE, $value ), true );
            $this->jsbuf .= sprintf(' = %s[%s];', $arr, $key );
            
            // advance to next token.  may be an opening brace.
            $idx = $this->consume_whitespace( $idx + 1 );
            $open_brace_or_other = $this->get_token_name_by_idx( $idx );
            if( $open_brace_or_other == '{') {
                $idx ++;
            }
            else { // single statement foreach, no braces used.  So we need to add a closing brace at end of statement.
                $idx2 = $this->advance_to_token( $idx + 1, ';' );
                $this->tokens = array_insert( $this->tokens, $idx2+1, '}');
                $idx --;
//            $this->_print_tokens($this->tokens); exit;
            }
            
            return $idx - $this->idx_current_token;
    }
    
    function consume_whitespace($idx) {
        $token_name = $this->get_token_name_by_idx( $idx );
        while( $token_name == 'T_WHITESPACE' ) {
            $idx ++;
            $token_name = $this->get_token_name_by_idx( $idx );
        }
        return $idx;
    }

    function consume_whitespace_reverse($idx) {
        $token_name = $this->get_token_name_by_idx( $idx );
        while( $token_name == 'T_WHITESPACE' ) {
            $idx --;
            $token_name = $this->get_token_name_by_idx( $idx );
        }
        return $idx;
    }


    function advance_to_token($idx, $token_name_target) {
        $token_name = $this->get_token_name_by_idx( $idx );
        while( $token_name != $token_name_target ) {
            $idx ++;
            $token_name = $this->get_token_name_by_idx( $idx );
        }
        return $idx;
    }

    
    function handle_char( $char ) {
        switch( $char ) {
            case ';':
                $this->_apos();
                break;
            case '"':
                $this->in_quoted_string = !$this->in_quoted_string;
                $this->jsbuf .= $char;
                break;
            case '.':
                $this->jsbuf .= '+';
                break;
            case ',':
                if( $this->array_brace_count ) {
                    if( aget( $this->array_assoc_count, $this->array_brace_count ) ) {
                        $this->array_assoc_count[$this->array_brace_count] --;
                        $this->jsbuf .= ']';
                    }
                }
                $this->jsbuf .= ',';
                break;
            case '{':
                $this->start_brace();
                break;
            case '}':
                $this->end_brace();
                break;
            case '(':
                $this->start_paren();
                break;
            case ')':
                $this->end_paren();
                break;
            default:
                $this->jsbuf .= $char;
                break;
        }
    }
    
    function start_brace() {
        
        $this->begin_statement_list();
        
        $this->context[] = $char;
        // create new variable scope
        $this->local_scope[] = array();
        if( $this->context(1) == 'function' ) {
            // specify that this is function scope, which is special.
            $this->local_scope[count($this->local_scope)-1]['___scope_func'] = true;
        }
        $this->jsbuf .= $char;
    }
    
    function end_brace() {
        array_pop( $this->context );

//        $this->end_statement_list();
        
        if( !in_array($this->context(0), array('(','{') ) ) {
            array_pop( $this->context );
        }
        
        array_pop( $this->local_scope );
        $this->jsbuf .= $char;
    }

    function start_paren() {
        $this->context[] = $char;
        
        if( $this->array_brace_count ) {
            break;
        }
        $this->jsbuf .= $char;
    }
    
    function _apos() {
        if( !in_array( $this->context(0), array('(','{') ) ) {
            array_pop( $this->context );
//            $this->end_statement_list();
        }
        
        $this->jsbuf .= $char;
    }
    
    function end_paren() {
        array_pop( $this->context );
        if( $this->array_brace_count ) {
            if( aget( $this->array_assoc_count, $this->array_brace_count ) ) {
                $this->array_assoc_count[$this->array_brace_count] --;
                $this->jsbuf .= ']';
            }
            $this->array_brace_count --;
        }
        $this->jsbuf .= ')';
    }

    function begin_statement_list() {
        $this->curnode = $this->curnode->addChild('Statement_list');
    }
    
    function _eval_expr() {
        $this->curnode = $this->curnode->addChild('Eval_expr');
        $this->curnode->addChild('attrs');
    }
    
    function _method_invocation( $method_name ) {
        $this->curnode = $root = $this->curnode->addChild('Method_invocation');
        $this->curnode->addChild('attrs');
        $this->curnode = $this->curnode->addChild('METHOD_NAME');
        $this->curnode->addChild('attrs');
        $this->curnode->addChild('value', $method_name );
        $this->curnode = $root;
        $this->curnode->addChild('Actual_parameter_list');
    }

    function t_double_arrow( $token ) {
        $this->jsbuf .= ',';        
    }

}

function aget( $arr, $key ) {
    return isset( $arr[$key]) ? $arr[$key] : null;
}

function array_insert($array,$pos,$val)
{
    $array2 = array_splice($array,$pos);
    $array[] = $val;
    $array = array_merge($array,$array2);
  
    return $array;
}

?>