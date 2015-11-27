<?php

function __php__method_exists($classref,$methodname){

JS( <<< END_JS
    return classref && typeof classref == 'object' && typeof classref[methodname] == 'function';

END_JS
);
}

function __php__property_exists($cls,$prop){

JS( <<< END_JS
    return cls && typeof cls[prop] != "undefined";

END_JS
);
}

function __php__get_class_methods($classref){

JS( <<< END_JS
    if (typeof classref == 'String') {
        classref = eval(classref);
    }
    methods = [];
    for (var x in classref) {
        if (method_exists(classref, x)) {
            methods[methods.length] = x;
        }
    }
    return methods;

END_JS
);
}

function __php__array_splice($arr,$idx,$length,$replace){

JS( <<< END_JS
    if (replace == undefined) {
        arr.splice(idx, length);
    }
    else {
        arr.splice(idx, length, replace);
    }

END_JS
);
}