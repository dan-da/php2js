
function ___array() {
  var arr = [];
  for (var i = 0; i < ___array.arguments.length; ++i) {
    var item = ___array.arguments[i];
    if(item instanceof Array && item.length == 3 && item[0] == '__kv') {
        arr[item[1]] = item[2];
    }
    else {
        arr.push( item );
    }
  }
  return arr;
}

/** NOTE:  experimental.  currently unused by php2js. */
function ___unset(array,index) {
    if (typeof array === 'object' && typeof array.length == 'number') {
        array.splice(index, 1); // Using the delete operator will replace the old value
        // with "undefined" in its old slot, but we also want to remove the slot itself,
        // so with arrays (in IE too), we can safely use splice().
    }
    else { // Objects
        delete array[index]; // For object properties, this works pretty well, except potentially in IE where
        // the property will thankfully no longer be iterated, but it has the annoying feature (for
        // the sake of our using objects to imitate PHP associative arrays) that if you later try to
        // add back a value with the same property name, it will put your new value in the old
        // iteration position.  So IE does not truly delete the property, though it may appear that way.
        // All other popular browser implementation seem to truly delete the property (and iterate
        // in order), at least if it is not an inherited property, but the latest ES spec wasn't able
        // to persuade IE to change this behavior
    }
}

function getparam(Name, ReturnStyle, QueryString) {

	var AllElements, CurElement, CurName, CurVal, ReturnVal

		// Set the Name
	Name = Name.replace(/^\s*|\s*$/g,'');
		// Init the return
	ReturnVal = null;

		// Determine the string to use
	if ( !QueryString ) {
		QueryString = location.search;
	};
		// Split the query string on the ampersand (the substring removes the question mark)
	AllElements = QueryString.substring(1).split('&');

		// Loop over the string
	for( var Cnt = 0; Cnt < AllElements.length; Cnt++) {
			// Split the current element on the equals sign
		CurElement = AllElements[Cnt].split('=');
			// Unescape and Trim the returned name
		CurName = unescape(CurElement[0]).replace(/^\s*|\s*$/g,'');
		if ( Name == CurName ) {
				// Generate the array if needed
			if ( !ReturnVal ) { ReturnVal = new Array };
				// Get the Value
			CurVal = CurElement[1];
				// Determine how the value should be represented
			if ( CurVal ) {
				CurVal = unescape(CurVal);
			} else {
				CurVal = '';
			};
			ReturnVal[ReturnVal.length] = CurVal;
		};
	};

        return ReturnVal;

};

Function.prototype.inheritsFrom = function( parentClassOrObject ){
        p = this.prototype;
	if ( parentClassOrObject.constructor == Function ) 
	{
	    for( x in parentClassOrObject ) {
	      this[x] = parentClassOrObject[x];
	    }
            /* Normal Inheritance */
            this.prototype = new parentClassOrObject;
            this.prototype.constructor = this;
            this.prototype.__parent = parentClassOrObject.prototype;
	} 
	else 
	{ 
            /* Pure Virtual Inheritance */
            this.prototype = parentClassOrObject;
            this.prototype.constructor = this;
            this.prototype.__parent = parentClassOrObject;
	} 
	return this;
}
function prepare_str_concat(v) {if(v==undefined) v='';return v;}
function ___echo(v) {
    if(typeof document=='undefined') {
        if ( console && typeof console.log == 'function') {
            console.log( v )
        }
        print(v);
    }
    else document.write(v);
}

function ___clone (o) {
    function c(o) {
        for (var i in o) {
            this[i] = o[i];
        }
    }
    var d = new c(o);
    if( d.__clone ) {
        d.__clone();
    }
    return d;
}
