/**
 * php.extra.js
 *
 * This file is intended as an addition to php.js (aka php.js.php).
 *
 * php.js is a 3rd party resource lib.  As such, I prefer to leave it
 * untouched.  However, there are some native PHP funcs that php.js
 * does not (yet) have.
 *
 * So to be clear, in this file we place ONLY functions that:
 *   1) Are PHP native functions
 *   2) Do NOT already have an implementation in php.js
 *
 * We will also attempt to contribute to php.js such that
 * any functions implemented here get included into upstream
 * php.js, and can then be removed from this file.
 *
 */

function method_exists( classref, methodname ) {
    return classref && typeof classref == 'object' && typeof classref[methodname] == 'function';
}

function property_exists( cls, prop ) {
    return cls && typeof cls[prop] != "undefined";
}

function get_class_methods( classref ) {
    if( typeof classref == 'String' ) {
        classref = eval(classref);
    }
    methods = [];
    for( var x in classref ) {
        if( method_exists( classref, x ) ) {
            methods[methods.length] = x;
        }
    }
    return methods;
}

function var_dump( v ) {
    return var_export(v, true);
}

function array_splice(arr, idx, length, replace ) {
    // TODO: replace is not yet fully supported.
    // It should be able to handle case where replace is an array
    if( replace == undefined ) {
        arr.splice( idx, length);    
    }
    else {
        arr.splice( idx, length, replace );    
    }
}

function preg_match( pattern, subject, matches, flags, offset ) {
    
    if( typeof matches == 'undefined') {
	matches = {};
    }
    
    // matches must be an object.
    matches.o = [];
	
    if( pattern.length == 0) {
        return 0;
    }
    
    var token = pattern[0];

    var parts = pattern.split(token);
    
    parts.shift();                        // first string is empty.
    var pattern_flags = parts.pop();      // last string contains flags
    pattern = parts.join(token);

    var regex = new RegExp(pattern, pattern_flags);
    var result = regex.exec( subject );

    // matches = result;
    if( result !== null ) {
	for( var i = 0; i < result.length; i++) {
	    matches.o.push( result[i] );
	}
    }

    return matches.o.length ? 1 : 0;
}

// no-ops
function set_include_path() {}
function get_include_path() {return '';}

// constants
define( 'PATH_SEPARATOR', '/');
