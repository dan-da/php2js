<?php
function ___array(){

JS( <<< END_JS
    var arr = [];
    for (var i = 0; i < ___array.arguments.length; ++i) {
        var item = ___array.arguments[i];
        if (item instanceof Array && item.length == 3 && item[0] == '__kv') {
            arr[item[1]] = item[2];
        }
        else {
            arr.push(item);
        }
    }
    return arr;

END_JS
);
}


function getparam($Name,$ReturnStyle,$QueryString){

JS( <<< END_JS

    var AllElements,
    CurElement,
    CurName,
    CurVal,
    ReturnVal

    Name = Name.replace(/^\s*|\s*\$/g, '');
    ReturnVal = null;

    if (!QueryString) {
        QueryString = location.search;
    };
    AllElements = QueryString.substring(1).split('&');

    for (var Cnt = 0; Cnt < AllElements.length; Cnt++) {
        CurElement = AllElements[Cnt].split('=');
        CurName = unescape(CurElement[0]).replace(/^\s*|\s*\$/g, '');
        if (Name == CurName) {
            if (!ReturnVal) {
                ReturnVal = new Array
            };
            CurVal = CurElement[1];
            if (CurVal) {
                CurVal = unescape(CurVal);
            } else {
                CurVal = '';
            };
            ReturnVal[ReturnVal.length] = CurVal;
        };
    };

    return ReturnVal;


END_JS
);
}
JS( <<< END_JS
;

Function.prototype.inheritsFrom = function(parentClassOrObject) {
    p = this.prototype;
    if (parentClassOrObject.constructor == Function)
    {
        this.prototype = new parentClassOrObject;
        this.prototype.constructor = this;
        this.prototype.__parent = parentClassOrObject.prototype;
    }
    else
    {
        this.prototype = parentClassOrObject;
        this.prototype.constructor = this;
        this.prototype.__parent = parentClassOrObject;
    }
    return this;
}

END_JS
);
function prepare_str_concat($v){

JS( <<< END_JS
    if (v == undefined) v = '';
    return v;
END_JS
);
}
function ___echo($v){

JS( <<< END_JS
    if (typeof document == 'undefined') print(v);
    else document.write(v);
END_JS
);
}

function ___clone($o){

JS( <<< END_JS
    function c(o) {
        for (var i in o) {
            this[i] = o[i];
        }
    }
    var d = new c(o);
    if (d.__clone) {
        d.__clone();
    }
    return d;

END_JS
);
}