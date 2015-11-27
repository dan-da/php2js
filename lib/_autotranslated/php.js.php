<?php


JS( <<< END_JS
if (typeof(window) == 'undefined') {
    window = this;
}


END_JS
);
function __php__array(){

JS( <<< END_JS
    return Array.prototype.slice.call(arguments);

END_JS
);
}
function __php__array_change_key_case($array){

JS( <<< END_JS
    var case_fn,
    tmp_ar = new Object,
    argc = arguments.length,
    argv = arguments,
    key;

    if (array instanceof Array) {
        return array;
    }

    if (array instanceof Object) {
        if (argc == 1 || argv[1] == 'CASE_LOWER' || argv[1] == 0) {
            case_fn = "toLowerCase";
        } else {
            case_fn = "toUpperCase";
        }
        for (var key in array) {
            tmp_ar[key[case_fn]()] = array[key];
        }
        return tmp_ar;
    }

    return false;

END_JS
);
}
function __php__array_chunk($input,$size){

JS( <<< END_JS
    for (var x, i = 0, c = -1, l = input.length, n = []; i < l; i++) {
        (x = i % size) ? n[c][x] = input[i] : n[++c] = [input[i]];
    }

    return n;

END_JS
);
}
function __php__array_combine($keys,$values){

JS( <<< END_JS
    var new_array = {},
    keycount = keys.length,
    i;

    if (!keys || !values || keys.constructor !== Array || values.constructor !== Array) {
        return false;
    }

    if (keycount != values.length) {
        return false;
    }

    for (i = 0; i < keycount; i++) {
        new_array[keys[i]] = values[i];
    }

    return new_array;

END_JS
);
}
function __php__array_count_values($array){

JS( <<< END_JS
    var tmp_arr = {},
    key = '',
    t = '';

    var __getType = function(obj) {
        var t = typeof obj;
        t = t.toLowerCase();
        if (t == "object") {
            t = "array";
        }
        return t;
    }

    var __countValue = function(value) {
        switch (typeof(value)) {
        case "number":
            if (Math.floor(value) != value) {
                return;
            }
        case "string":
            if (value in this) {
                ++this[value];
            } else {
                this[value] = 1;
            }
        }
    };

    t = __getType(array);
    if (t == 'array') {
        for (key in array) {
            __countValue.call(tmp_arr, array[key]);
        }
    }
    return tmp_arr;

END_JS
);
}
function __php__array_diff($array){

JS( <<< END_JS
    var arr_dif = [],
    i = 1,
    argc = arguments.length,
    argv = arguments,
    key,
    key_c,
    found = false,
    cntr = 0;

    for (key in array) {
        for (i = 1; i < argc; i++) {
            found = false;
            for (key_c in argv[i]) {
                if (argv[i][key_c] == array[key]) {
                    found = true;
                    break;
                }
            }

            if (!found) {
                arr_dif[cntr] = array[key];
                cntr++;
            }
        }
    }

    return arr_dif;

END_JS
);
}
function __php__array_diff_assoc($array){

JS( <<< END_JS
    var arr_dif = {},
    i = 1,
    argc = arguments.length,
    argv = arguments,
    key,
    key_c,
    found = false;

    if (!array || (array.constructor !== Array && array.constructor !== Array && typeof array != 'object' && typeof array != 'array')) {
        return null;
    }

    for (key in array) {
        for (i = 1; i < argc; i++) {
            found = false;
            if (argv[i][key] && argv[i][key] == array[key]) {
                found = true;
                break;
            }

            if (!found) {
                arr_dif[key] = array[key];
            }
        }
    }

    return arr_dif;

END_JS
);
}
function __php__array_diff_key($object){

JS( <<< END_JS
    var tpm_ar = new Object(),
    argc = arguments.length,
    argv = arguments,
    key,
    argidx,
    other;

    for (key in object) {
        tpm_ar[key] = object[key];
    }
    for (argidx = 1; argidx < argc; ++argidx) {
        other = argv[argidx];

        if (other instanceof Object) {
            for (key in other) {
                delete tpm_ar[key];
            }
        }
    }

    return tpm_ar;

END_JS
);
}
function __php__array_fill($start_index,$num,$mixed_val){

JS( <<< END_JS
    var key,
    tmp_arr = {};

    if (!isNaN(start_index) && !isNaN(num)) {
        for (key = 0; key < num; key++) {
            tmp_arr[(key + start_index)] = mixed_val;
        }
    }

    return tmp_arr;

END_JS
);
}
function __php__array_fill_keys($keys,$value){

JS( <<< END_JS
    var retObj = {},
    key = '';

    for (key in keys) {
        retObj[keys[key]] = value;
    }

    return retObj;

END_JS
);
}
function __php__array_filter($arr,$func){

JS( <<< END_JS
    var retObj = {},
    k;

    for (k in arr) {
        if (func(arr[k])) {
            retObj[k] = arr[k];
        }
    }

    return retObj;

END_JS
);
}
function __php__array_flip($trans){

JS( <<< END_JS
    var key,
    tmp_ar = {};

    for (key in trans) {
        tmp_ar[trans[key]] = key;
    }

    return tmp_ar;

END_JS
);
}
function __php__array_key_exists($key,$search){

JS( <<< END_JS
    if (!search || (search.constructor !== Array && search.constructor !== Object)) {
        return false;
    }

    return key in search;

END_JS
);
}
function __php__array_keys($input,$search_value,$strict){

JS( <<< END_JS
    var tmp_arr = {},
    strict = !!strict,
    include = true,
    cnt = 0;

    for (key in input) {
        include = true;
        if (search_value != undefined) {
            if (strict && input[key] !== search_value) {
                include = false;
            } else if (input[key] != search_value) {
                include = false;
            }
        }

        if (include) {
            tmp_arr[cnt] = key;
            cnt++;
        }
    }

    return tmp_arr;

END_JS
);
}
function __php__array_map($callback){

JS( <<< END_JS
    var argc = arguments.length,
    argv = arguments;
    var j = argv[1].length,
    i = 0,
    k = 1,
    m = 0;
    var tmp = [],
    tmp_ar = [];

    while (i < j) {
        while (k < argc) {
            tmp[m++] = argv[k++][i];
        }

        m = 0;
        k = 1;

        if (callback) {
            tmp_ar[i++] = callback.apply(null, tmp);
        } else {
            tmp_ar[i++] = tmp;
        }

        tmp = [];
    }

    return tmp_ar;

END_JS
);
}
function __php__array_merge(){

JS( <<< END_JS
    var args = Array.prototype.slice.call(arguments);
    var retObj = {},
    k,
    j = 0,
    i = 0;
    var retArr;

    for (i = 0, retArr = true; i < args.length; i++) {
        if (! (args[i] instanceof Array)) {
            retArr = false;
            break;
        }
    }

    if (retArr) {
        return args;
    }
    var ct = 0;

    for (i = 0, ct = 0; i < args.length; i++) {
        if (args[i] instanceof Array) {
            for (j = 0; j < args[i].length; j++) {
                retObj[ct++] = args[i][j];
            }
        } else {
            for (k in args[i]) {
                if (is_int(k)) {
                    retObj[ct++] = args[i][k];
                } else {
                    retObj[k] = args[i][k];
                }
            }
        }
    }

    return retObj;

END_JS
);
}
function __php__array_merge_recursive($arr1,$arr2){

JS( <<< END_JS
    if ((arr1 && (arr1 instanceof Array)) && (arr2 && (arr2 instanceof Array))) {
        for (var idx in arr2) {
            arr1.push(arr2[idx]);
        }
    } else if ((arr1 && (arr1 instanceof Object)) && (arr2 && (arr2 instanceof Object))) {
        for (var idx in arr2) {
            if (idx in arr1) {
                if (typeof arr1[idx] == 'object' && typeof arr2 == 'object') {
                    arr1[idx] = array_merge(arr1[idx], arr2[idx]);
                } else {
                    arr1[idx] = arr2[idx];
                }
            } else {
                arr1[idx] = arr2[idx];
            }
        }
    }

    return arr1;

END_JS
);
}
function __php__array_pad($input,$pad_size,$pad_value){

JS( <<< END_JS
    var pad = [],
    newArray = [],
    newLength,
    i = 0;

    if (input instanceof Array && !isNaN(pad_size)) {
        newLength = ((pad_size < 0) ? (pad_size * -1) : pad_size);
        if (newLength > input.length) {
            for (i = 0; i < (newLength - input.length); i++) {
                newArray[i] = pad_value;
            }
            pad = ((pad_size < 0) ? newArray.concat(input) : input.concat(newArray));
        } else {
            pad = input;
        }
    }

    return pad;

END_JS
);
}
function __php__array_pop($array){

JS( <<< END_JS
    if (!array.length) {
        return null;
    }

    return array.pop();

END_JS
);
}
function __php__array_product($input){

JS( <<< END_JS
    var Index = 0,
    Product = 1;
    if (input instanceof Array) {
        while (Index < input.length) {
            Product *= (!isNaN(input[Index]) ? input[Index] : 0);
            Index++;
        }
    } else {
        Product = null;
    }

    return Product;

END_JS
);
}
function __php__array_push($array){

JS( <<< END_JS
    var i,
    argv = arguments,
    argc = argv.length;

    for (i = 1; i < argc; i++) {
        array[array.length++] = argv[i];
    }

    return array.length;

END_JS
);
}
function __php__array_rand($input,$num_req){

JS( <<< END_JS
    var Indexes = [];
    var Ticks = num_req || 1;
    var checkDuplicate = function(input, value) {
        var Exist = false,
        Index = 0;
        while (Index < input.length) {
            if (input[Index] === value) {
                Exist = true;
                break;
            }
            Index++;
        }
        return Exist;
    };

    if (input instanceof Array && Ticks <= input.length) {
        while (true) {
            var Rand = Math.floor((Math.random() * input.length));
            if (Indexes.length === Ticks) {
                break;
            }
            if (!checkDuplicate(Indexes, Rand)) {
                Indexes.push(Rand);
            }
        }
    } else {
        Indexes = null;
    }

    return ((Ticks == 1) ? Indexes.join() : Indexes);

END_JS
);
}
function __php__array_reduce($a_input,$callback){

JS( <<< END_JS
    var lon = a_input.length;
    var res = 0,
    i = 0;
    var tmp = new Array();


    for (i = 0; i < lon; i += 2) {
        tmp[0] = a_input[i];
        if (a_input[(i + 1)]) {
            tmp[1] = a_input[(i + 1)];
        } else {
            tmp[1] = 0;
        }
        res += callback.apply(null, tmp);
        tmp = new Array();
    }

    return res;

END_JS
);
}
function __php__array_reverse($array,$preserve_keys){

JS( <<< END_JS
    var arr_len = array.length,
    newkey = 0,
    tmp_ar = {};

    for (var key in array) {
        newkey = arr_len - key - 1;
        tmp_ar[( !! preserve_keys) ? newkey: key] = array[newkey];
    }

    return tmp_ar;

END_JS
);
}
function __php__array_search($needle,$haystack,$strict){

JS( <<< END_JS
    var strict = !!strict;

    for (var key in haystack) {
        if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
            return key;
        }
    }

    return false;

END_JS
);
}
function __php__array_shift($array){

JS( <<< END_JS
    if (array.length > 0) {
        return array.shift();
    }

    return null;

END_JS
);
}
function __php__array_slice($arr,$offst,$lgth,$preserve_keys){

JS( <<< END_JS

    if (! (arr instanceof Array) || (preserve_keys && offst != 0)) {
        var lgt = 0,
        newAssoc = {};
        for (var key in arr) {
            lgt += 1;
            newAssoc[key] = arr[key];
        }
        arr = newAssoc;

        offst = (offst < 0) ? lgt + offst: offst;
        lgth = lgth == undefined ? lgt: (lgth < 0) ? lgt + lgth - offst: lgth;

        var assoc = {};
        var start = false,
        it = -1,
        arrlgth = 0,
        no_pk_idx = 0;
        for (var key in arr) {
            ++it;
            if (arrlgth >= lgth) {
                break;
            }
            if (it == offst) {
                start = true;
            }
            if (!start) {
                continue;
            }
            ++arrlgth;
            if (is_int(key) && !preserve_keys) {
                assoc[no_pk_idx++] = arr[key];
            } else {
                assoc[key] = arr[key];
            }
        }
        return assoc;
    }

    if (lgth === undefined) {
        return arr.slice(offst);
    } else if (lgth >= 0) {
        return arr.slice(offst, offst + lgth);
    } else {
        return arr.slice(offst, lgth);
    }


END_JS
);
}
function __php__array_sum($array){

JS( <<< END_JS
    var key,
    sum = 0;

    if (!array || (array.constructor !== Array && array.constructor !== Object) || !array.length) {
        return null;
    }

    for (key in array) {
        sum += array[key];
    }

    return sum;

END_JS
);
}
function __php__array_unique($array){

JS( <<< END_JS
    var key = '',
    tmp_arr1 = {},
    tmp_arr2 = {};
    var val = '';
    tmp_arr1 = array;

    var __array_search = function(needle, haystack, strict) {
        var fkey = '';
        var strict = !!strict;
        for (fkey in haystack) {
            if ((strict && haystack[fkey] === needle) || (!strict && haystack[fkey] == needle)) {
                return fkey;
            }
        }
        return false;
    }

    for (key in tmp_arr1) {
        val = tmp_arr1[key];
        if (false === __array_search(val, tmp_arr2)) {
            tmp_arr2[key] = val;
        }

        delete tmp_arr1[key];
    }

    return tmp_arr2;

END_JS
);
}
function __php__array_unshift($array){

JS( <<< END_JS
    var argc = arguments.length,
    argv = arguments,
    i;

    for (i = 1; i < argc; i++) {
        array.unshift(argv[i]);
    }

    return (array.length);

END_JS
);
}
function __php__array_values($input){

JS( <<< END_JS
    var tmp_arr = new Array(),
    cnt = 0;

    for (key in input) {
        tmp_arr[cnt] = input[key];
        cnt++;
    }

    return tmp_arr;

END_JS
);
}
function __php__array_walk($array,$funcname,$userdata){

JS( <<< END_JS
    var key;

    if (typeof array != 'object') {
        return false;
    }

    for (key in array) {
        if (typeof(userdata) != 'undefined') {
            eval(funcname + '( array [key] , key , userdata  )');
        } else {
            eval(funcname + '(  userdata ) ');
        }
    }

    return true;

END_JS
);
}
function __php__array_walk_recursive($array,$funcname,$userdata){

JS( <<< END_JS
    var key;

    if (typeof array != 'object') {
        return false;
    }

    for (key in array) {
        if (typeof array[key] == 'object') {
            return array_walk_recursive(array[key], funcname, userdata);
        }

        if (typeof(userdata) != 'undefined') {
            eval(funcname + '( array [key] , key , userdata  )');
        } else {
            eval(funcname + '(  userdata ) ');
        }
    }

    return true;

END_JS
);
}
function __php__chunk_split($body,$chunklen,$end){

JS( <<< END_JS
    if (chunklen < 1) {
        return false;
    }

    var result = '',
    chunklen = chunklen || 76,
    end = end || '\r\n';

    while (body.length > chunklen) {
        result += body.substring(0, chunklen) + end;
        body = body.substring(chunklen);
    }

    return result + body + end;

END_JS
);
}
function __php__compact($var_names){

JS( <<< END_JS
    var Index = 0,
    Matrix = {};
    var process = function(value) {
        var i = 0,
        l = value.length,
        key_value = '';
        for (i = 0; i < l; i++) {
            var key_value = value[i];
            if (key_value instanceof Array) {
                process(key_value);
            } else {
                if (typeof window[key_value] !== 'undefined') {
                    Matrix[key_value] = window[key_value];
                }
            }
        }
        return true;
    };

    process(arguments);
    return Matrix;

END_JS
);
}
function __php__count($mixed_var,$mode){

JS( <<< END_JS
    var key,
    cnt = 0;

    if (mode == 'COUNT_RECURSIVE') mode = 1;
    if (mode != 1) mode = 0;

    for (key in mixed_var) {
        cnt++;
        if (mode == 1 && mixed_var[key] && (mixed_var[key].constructor === Array || mixed_var[key].constructor === Object)) {
            cnt += count(mixed_var[key], 1);
        }
    }

    return cnt;

END_JS
);
}
function __php__each($arr){

JS( <<< END_JS

    var k,
    v;

    if (! (arr instanceof Object) || (arr._keys && !arr._keys.length)) {
        return false;
    }

    if (!arr._keys) {
        arr._keys = [];

        for (k in arr) {
            if (k != "_keys") {
                arr._keys.push(k);
            }
        }
    }

    k = arr._keys.shift();
    v = arr[k];

    return {
        0: k,
        1: v,
        key: k,
        value: v
    };

END_JS
);
}
function __php__end($array){

JS( <<< END_JS
    var last_elm,
    key;

    if (array.constructor == Array) {
        last_elm = array[(array.length - 1)];
    } else {
        for (key in array) {
            last_elm = array[key];
        }
    }

    return last_elm;

END_JS
);
}
function __php__in_array($needle,$haystack,$strict){

JS( <<< END_JS
    var found = false,
    key,
    strict = !!strict;

    for (key in haystack) {
        if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
            found = true;
            break;
        }
    }

    return found;

END_JS
);
}
function __php__krsort($array,$sort_flags){

JS( <<< END_JS
    var tmp_arr = {},
    values = array,
    keys = [],
    key_num = 0,
    key = '',
    i = 0;
    var sorter = false,
    array = false;

    if (sort_flags == 'SORT_NUMERIC') {
        sorter = function(a, b) {
            return (a - b);
        };
    }

    for (key in values) {
        keys[key_num++] = key;
    }

    if (sorter !== false) {
        keys = keys.sort(sorter);
    } else {
        keys = keys.sort();
    }

    keys.reverse();

    for (i = 0; i < key_num; i++) {
        key = keys[i];
        tmp_arr[key] = values[key];
    }

    array = tmp_arr;
    return true;

END_JS
);
}
function __php__ksort($array,$sort_flags){

JS( <<< END_JS
    var tmp_arr = {},
    values = array,
    keys = [],
    key_num = 0,
    key = '',
    i = 0;
    var sorter = false,
    array = false;

    if (sort_flags == 'SORT_NUMERIC') {
        sorter = function(a, b) {
            return (a - b);
        };
    }

    for (key in values) {
        keys[key_num++] = key;
    }

    if (sorter !== false) {
        keys = keys.sort(sorter);
    } else {
        keys = keys.sort();
    }

    for (i = 0; i < key_num; i++) {
        key = keys[i];
        tmp_arr[key] = values[key];
    }

    array = tmp_arr;
    return true;

END_JS
);
}
function __php__range($low,$high,$step){

JS( <<< END_JS
    var matrix = [];
    var inival,
    endval,
    plus;
    var walker = step || 1;
    var chars = false;

    if (!isNaN(low) && !isNaN(high)) {
        inival = low;
        endval = high;
    } else if (isNaN(low) && isNaN(high)) {
        chars = true;
        inival = low.charCodeAt(0);
        endval = high.charCodeAt(0);
    } else {
        inival = (isNaN(low) ? 0: low);
        endval = (isNaN(high) ? 0: high);
    }

    plus = ((inival > endval) ? false: true);
    if (plus) {
        while (inival <= endval) {
            matrix.push(((chars) ? String.fromCharCode(inival) : inival));
            inival += walker;
        }
    } else {
        while (inival >= endval) {
            matrix.push(((chars) ? String.fromCharCode(inival) : inival));
            inival -= walker;
        }
    }

    return matrix;

END_JS
);
}
function __php__reset($array){

JS( <<< END_JS
    var first_elm,
    key;

    if (array.constructor == Array) {
        first_elm = array[0];
    } else {
        for (key in array) {
            first_elm = array[key];
            break;
        }
    }

    return first_elm;

END_JS
);
}
function __php__rsort($array,$sort_flags){

JS( <<< END_JS
    var sorter = false;

    if (sort_flags == 'SORT_NUMERIC') {
        sorter = function(a, b) {
            return (a - b);
        };
    }

    if (sorter !== false) {
        array.sort(sorter);
    } else {
        array.sort();
    }

    array.reverse();

    return true;

END_JS
);
}
function __php__shuffle($array){

JS( <<< END_JS
    array.sort(function() {
        return 0.5 - Math.random();
    });
    return true;

END_JS
);
}
function __php__sizeof($mixed_var,$mode){

JS( <<< END_JS
    return count(mixed_var, mode);

END_JS
);
}
function __php__sort($array,$sort_flags){

JS( <<< END_JS
    var sorter = false;

    if (sort_flags == 'SORT_NUMERIC') {
        sorter = function(a, b) {
            return (a - b);
        };
    }

    if (sorter !== false) {
        array.sort(sorter);
    } else {
        array.sort();
    }

    return true;

END_JS
);
}
function __php__get_class($obj){

JS( <<< END_JS
    if (obj instanceof Object && !(obj instanceof Array)
    && !(obj instanceof Function) && obj.constructor
    && obj != window) {
        var arr = obj.constructor.toString().match(/function\s*(\w+)/);

        if (arr && arr.length == 2) {
            return arr[1];
        }
    }

    return false;

END_JS
);
}
function __php__checkdate($month,$day,$year){

JS( <<< END_JS
    var myDate = new Date();
    myDate.setFullYear(year, (month - 1), day);

    return ((myDate.getMonth() + 1) == month && day < 32);

END_JS
);
}
function __php__date($format,$timestamp){

JS( <<< END_JS
    var a,
    jsdate = ((timestamp) ? new Date(timestamp * 1000) : new Date());
    var pad = function(n, c) {
        if ((n = n + "").length < c) {
            return new Array(++c - n.length).join("0") + n;
        } else {
            return n;
        }
    };
    var txt_weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday",
    "Thursday", "Friday", "Saturday"];
    var txt_ordin = {
        1: "st",
        2: "nd",
        3: "rd",
        21: "st",
        22: "nd",
        23: "rd",
        31: "st"
    };
    var txt_months = ["", "January", "February", "March", "April",
    "May", "June", "July", "August", "September", "October", "November",
    "December"];

    var f = {
        d: function() {
            return pad(f.j(), 2);
        },
        D: function() {
            t = f.l();
            return t.substr(0, 3);
        },
        j: function() {
            return jsdate.getDate();
        },
        l: function() {
            return txt_weekdays[f.w()];
        },
        N: function() {
            return f.w() + 1;
        },
        S: function() {
            return txt_ordin[f.j()] ? txt_ordin[f.j()] : 'th';
        },
        w: function() {
            return jsdate.getDay();
        },
        z: function() {
            return (jsdate - new Date(jsdate.getFullYear() + "/1/1")) / 864e5 >> 0;
        },

        W: function() {
            var a = f.z(),
            b = 364 + f.L() - a;
            var nd2,
            nd = (new Date(jsdate.getFullYear() + "/1/1").getDay() || 7) - 1;

            if (b <= 2 && ((jsdate.getDay() || 7) - 1) <= 2 - b) {
                return 1;
            } else {

                if (a <= 2 && nd >= 4 && a >= (6 - nd)) {
                    nd2 = new Date(jsdate.getFullYear() - 1 + "/12/31");
                    return date("W", Math.round(nd2.getTime() / 1000));
                } else {
                    return (1 + (nd <= 3 ? ((a + nd) / 7) : (a - (7 - nd)) / 7) >> 0);
                }
            }
        },

        F: function() {
            return txt_months[f.n()];
        },
        m: function() {
            return pad(f.n(), 2);
        },
        M: function() {
            t = f.F();
            return t.substr(0, 3);
        },
        n: function() {
            return jsdate.getMonth() + 1;
        },
        t: function() {
            var n;
            if ((n = jsdate.getMonth() + 1) == 2) {
                return 28 + f.L();
            } else {
                if (n & 1 && n < 8 || !(n & 1) && n > 7) {
                    return 31;
                } else {
                    return 30;
                }
            }
        },

        L: function() {
            var y = f.Y();
            return (! (y & 3) && (y % 1e2 || !(y % 4e2))) ? 1: 0;
        },
        Y: function() {
            return jsdate.getFullYear();
        },
        y: function() {
            return (jsdate.getFullYear() + "").slice(2);
        },

        a: function() {
            return jsdate.getHours() > 11 ? "pm": "am";
        },
        A: function() {
            return f.a().toUpperCase();
        },
        B: function() {
            var off = (jsdate.getTimezoneOffset() + 60) * 60;
            var theSeconds = (jsdate.getHours() * 3600) +
            (jsdate.getMinutes() * 60) +
            jsdate.getSeconds() + off;
            var beat = Math.floor(theSeconds / 86.4);
            if (beat > 1000) beat -= 1000;
            if (beat < 0) beat += 1000;
            if ((String(beat)).length == 1) beat = "00" + beat;
            if ((String(beat)).length == 2) beat = "0" + beat;
            return beat;
        },
        g: function() {
            return jsdate.getHours() % 12 || 12;
        },
        G: function() {
            return jsdate.getHours();
        },
        h: function() {
            return pad(f.g(), 2);
        },
        H: function() {
            return pad(jsdate.getHours(), 2);
        },
        i: function() {
            return pad(jsdate.getMinutes(), 2);
        },
        s: function() {
            return pad(jsdate.getSeconds(), 2);
        },
        O: function() {
            var t = pad(Math.abs(jsdate.getTimezoneOffset() / 60 * 100), 4);
            if (jsdate.getTimezoneOffset() > 0) t = "-" + t;
            else t = "+" + t;
            return t;
        },
        P: function() {
            var O = f.O();
            return (O.substr(0, 3) + ":" + O.substr(3, 2));
        },
        c: function() {
            return f.Y() + "-" + f.m() + "-" + f.d() + "T" + f.h() + ":" + f.i() + ":" + f.s() + f.P();
        },
        U: function() {
            return Math.round(jsdate.getTime() / 1000);
        }
    };

    return format.replace(/[\\]?([a-zA-Z])/g,
    function(t, s) {
        if (t != s) {
            ret = s;
        } else if (f[s]) {
            ret = f[s]();
        } else {
            ret = s;
        }

        return ret;
    });

END_JS
);
}
function __php__getdate($timestamp){

JS( <<< END_JS
    var _w = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var _m = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var d = (typeof timestamp == 'number') ? new Date(timestamp * 1000) : new Date();
    var w = d.getDay();
    var m = d.getMonth();
    var y = d.getFullYear();
    var r = {};

    r['seconds'] = d.getSeconds();
    r['minutes'] = d.getMinutes();
    r['hours'] = d.getHours();
    r['mday'] = d.getDate();
    r['wday'] = w;
    r['mon'] = m + 1;
    r['year'] = y;
    r['yday'] = Math.floor((d - (new Date(y, 0, 1))) / 86400000);
    r['weekday'] = _w[w];
    r['month'] = _m[m];
    r['0'] = parseInt(d.getTime() / 1000);

    return r;

END_JS
);
}
function __php__microtime($get_as_float){

JS( <<< END_JS
    var now = new Date().getTime() / 1000;
    var s = parseInt(now);

    return (get_as_float) ? now: (Math.round((now - s) * 1000) / 1000) + ' ' + s;

END_JS
);
}
function __php__mktime(){

JS( <<< END_JS
    var no,
    ma = 0,
    mb = 0,
    i = 0,
    d = new Date(),
    argv = arguments,
    argc = argv.length;
    d.setHours(0, 0, 0);
    d.setDate(1);
    d.setMonth(1);
    d.setYear(1972);

    var dateManip = {
        0: function(tt) {
            return d.setHours(tt);
        },
        1: function(tt) {
            return d.setMinutes(tt);
        },
        2: function(tt) {
            set = d.setSeconds(tt);
            mb = d.getDate() - 1;
            return set;
        },
        3: function(tt) {
            set = d.setMonth(parseInt(tt) - 1);
            ma = d.getFullYear() - 1972;
            return set;
        },
        4: function(tt) {
            return d.setDate(tt + mb);
        },
        5: function(tt) {
            return d.setYear(tt + ma);
        }
    };

    for (i = 0; i < argc; i++) {
        no = parseInt(argv[i] * 1);
        if (isNaN(no)) {
            return false;
        } else {
            if (!dateManip[i](no)) {
                return false;
            }
        }
    }

    return Math.floor(d.getTime() / 1000);

END_JS
);
}
function __php__time(){

JS( <<< END_JS
    return Math.round(new Date().getTime() / 1000);

END_JS
);
}
function __php__basename($path,$suffix){

JS( <<< END_JS
    var b = path.replace(/^.*[\/\\]/g, '');

    if (typeof(suffix) == 'string' && b.substr(b.length - suffix.length) == suffix) {
        b = b.substr(0, b.length - suffix.length);
    }

    return b;

END_JS
);
}
function __php__dirname($path){

JS( <<< END_JS
    return path.replace(/\\/g, '/').replace(/\/[^\/]*\/?\$/, '');

END_JS
);
}
function __php__file($url){

JS( <<< END_JS
    var req = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
    if (!req) throw new Error('XMLHttpRequest not supported');

    req.open("GET", url, false);
    req.send(null);

    return req.responseText.split('\n');

END_JS
);
}
function __php__file_exists($url){

JS( <<< END_JS
    var req = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
    if (!req) throw new Error('XMLHttpRequest not supported');

    req.open('HEAD', url, false);
    req.send(null);
    if (req.status == 200) {
        return true;
    }

    return false;

END_JS
);
}
function __php__file_get_contents($url){

JS( <<< END_JS
    var req = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
    if (!req) throw new Error('XMLHttpRequest not supported');

    req.open("GET", url, false);
    req.send(null);

    return req.responseText;

END_JS
);
}
function __php__filesize($url){

JS( <<< END_JS
    var req = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
    if (!req) throw new Error('XMLHttpRequest not supported');

    req.open('HEAD', url, false);
    req.send(null);

    if (!req.getResponseHeader) {
        try {
            throw new Error('No getResponseHeader!');
        } catch(e) {
            return false;
        }
    } else if (!req.getResponseHeader('Content-Length')) {
        try {
            throw new Error('No Content-Length!');
        } catch(e) {
            return false;
        }
    } else {
        return req.getResponseHeader('Content-Length');
    }

END_JS
);
}
function __php__call_user_func_array($func,$parameters){

JS( <<< END_JS
    if (typeof func == 'string') {
        if (typeof this[func] == 'function') {
            func = this[func];
        } else {
            func = (new Function(null, 'return ' + func))();
        }

        if (typeof func != 'function') {
            throw new Exception(func + ' is not a valid function');
        }
    }

    return func.apply(null, parameters);

END_JS
);
}
function __php__create_function($args,$code){

JS( <<< END_JS
    eval('var _oFunctionObject = function (' + args + ') { ' + code + '}');
    return _oFunctionObject;

END_JS
);
}
function __php__function_exists($function_name){

JS( <<< END_JS

    if (typeof function_name == 'string') {
        return (typeof window[function_name] == 'function');
    } else {
        return (function_name instanceof Function);
    }

END_JS
);
}
function __php__get_included_files(){

JS( <<< END_JS
    var cur_file = {};
    cur_file[window.location.href] = 1;
    if (!this.__php_js) this.__php_js = {};
    if (!this.__php_js.includes) this.__php_js.includes = cur_file;

    var includes = new Array();
    var i = 0;
    for (var key in this.__php_js.includes) {
        includes[i] = key;
        i++;
    }

    return includes;

END_JS
);
}
function __php__include($filename){

JS( <<< END_JS
    var js = document.createElement('script');
    js.setAttribute('type', 'text/javascript');
    js.setAttribute('src', filename);
    js.setAttribute('defer', 'defer');
    document.getElementsByTagName('HEAD')[0].appendChild(js);

    var cur_file = {};
    cur_file[window.location.href] = 1;

    if (!window.php_js) window.php_js = {};
    if (!window.php_js.includes) window.php_js.includes = cur_file;
    if (!window.php_js.includes[filename]) {
        window.php_js.includes[filename] = 1;
    } else {
        window.php_js.includes[filename]++;
    }

    return window.php_js.includes[filename];

END_JS
);
}
function __php__include_once($filename){

JS( <<< END_JS
    var cur_file = {};
    cur_file[window.location.href] = 1;

    if (!window.php_js) window.php_js = {};
    if (!window.php_js.includes) window.php_js.includes = cur_file;
    if (!window.php_js.includes[filename]) {
        if (include(filename)) {
            return true;
        }
    } else {
        return true;
    }

END_JS
);
}
function __php__require($filename){

JS( <<< END_JS
    var js_code = file_get_contents(filename);
    var script_block = document.createElement('script');
    script_block.type = 'text/javascript';
    var client_pc = navigator.userAgent.toLowerCase();
    if ((client_pc.indexOf("msie") != -1) && (client_pc.indexOf("opera") == -1)) {
        script_block.text = js_code;
    } else {
        script_block.appendChild(document.createTextNode(js_code));
    }

    if (typeof(script_block) != "undefined") {
        document.getElementsByTagName("head")[0].appendChild(script_block);

        var cur_file = {};
        cur_file[window.location.href] = 1;

        if (!window.php_js) window.php_js = {};
        if (!window.php_js.includes) window.php_js.includes = cur_file;

        if (!window.php_js.includes[filename]) {
            window.php_js.includes[filename] = 1;
        } else {
            return window.php_js.includes[filename] += 1;
        }
    }

END_JS
);
}
function __php__require_once($filename){

JS( <<< END_JS
    var cur_file = {};
    cur_file[window.location.href] = 1;

    if (!window.php_js) window.php_js = {};
    if (!window.php_js.includes) window.php_js.includes = cur_file;
    if (!window.php_js.includes[filename]) {
        if (require(filename)) {
            return true;
        }
    } else {
        return true;
    }

END_JS
);
}
function __php__abs($mixed_number){

JS( <<< END_JS
    return Math.abs(mixed_number) || 0;

END_JS
);
}
function __php__acos($arg){

JS( <<< END_JS
    return Math.acos(arg);

END_JS
);
}
function __php__acosh($arg){

JS( <<< END_JS
    return Math.log(arg + Math.sqrt(arg * arg - 1));

END_JS
);
}
function __php__asin($arg){

JS( <<< END_JS
    return Math.asin(arg);

END_JS
);
}
function __php__asinh($arg){

JS( <<< END_JS
    return Math.log(arg + Math.sqrt(arg * arg + 1));

END_JS
);
}
function __php__atan($arg){

JS( <<< END_JS
    return Math.atan(arg);

END_JS
);
}
function __php__atanh($arg){

JS( <<< END_JS
    return 0.5 * Math.log((1 + arg) / (1 - arg));

END_JS
);
}
function __php__base_convert($number,$frombase,$tobase){

JS( <<< END_JS
    return parseInt(number + '', frombase + 0).toString(tobase + 0);

END_JS
);
}
function __php__bindec($binary_string){

JS( <<< END_JS
    binary_string = (binary_string + '').replace(/[^01]/gi, '');
    return parseInt(binary_string, 2);

END_JS
);
}
function __php__ceil($value){

JS( <<< END_JS
    return Math.ceil(value);

END_JS
);
}
function __php__cos($arg){

JS( <<< END_JS
    return Math.cos(arg);

END_JS
);
}
function __php__cosh($arg){

JS( <<< END_JS
    return (Math.exp(arg) + Math.exp( - arg)) / 2;

END_JS
);
}
function __php__decbin($number){

JS( <<< END_JS
    return parseInt(number).toString(2);

END_JS
);
}
function __php__dechex($number){

JS( <<< END_JS
    return parseInt(number).toString(16);

END_JS
);
}
function __php__decoct($number){

JS( <<< END_JS
    return parseInt(number).toString(8);

END_JS
);
}
function __php__deg2rad($angle){

JS( <<< END_JS
    return (angle / 180) * Math.PI;

END_JS
);
}
function __php__exp($arg){

JS( <<< END_JS
    return Math.exp(arg);

END_JS
);
}
function __php__floor($value){

JS( <<< END_JS
    return Math.floor(value);

END_JS
);
}
function __php__fmod($x,$y){

JS( <<< END_JS
    var tmp,
    tmp2,
    p = 0,
    pY = 0,
    l = 0.0,
    l2 = 0.0;

    tmp = x.toExponential().match(/^.\.?(.*)e(.+)\$/);
    p = parseInt(tmp[2]) - (tmp[1] + '').length;
    tmp = y.toExponential().match(/^.\.?(.*)e(.+)\$/);
    pY = parseInt(tmp[2]) - (tmp[1] + '').length;

    if (pY > p) {
        p = pY;
    }

    tmp2 = (x % y);

    if (p < -100 || p > 20) {
        var l = Math.round(Math.log(tmp2) / Math.log(10));
        var l2 = Math.pow(10, l);

        return (tmp2 / l2).toFixed(l - p) * l2;
    } else {
        return parseFloat(tmp2.toFixed( - p));
    }

END_JS
);
}
function __php__getrandmax()
{

JS( <<< END_JS
    return 2147483647;

END_JS
);
}
function __php__hexdec($hex_string){

JS( <<< END_JS
    hex_string = (hex_string + '').replace(/[^a-f0-9]/gi, '');
    return parseInt(hex_string, 16);

END_JS
);
}
function __php__hypot($x,$y){

JS( <<< END_JS
    return Math.sqrt(x * x + y * y) || 0;

END_JS
);
}
function __php__is_finite($val){

JS( <<< END_JS
    var warningType = '';

    if (val === Infinity || val === -Infinity) {
        return false;
    }

    if (typeof val == 'object') {
        warningType = (val instanceof Array ? 'array': 'object');
    } else if (typeof val == 'string' && !val.match(/^[\+\-]?\d/)) {
        warningType = 'string';
    }
    if (warningType) {
        throw new Error('Warning: is_finite() expects parameter 1 to be double, ' + warningType + ' given');
    }

    return true;

END_JS
);
}
function __php__is_infinite($val){

JS( <<< END_JS
    var warningType = '';

    if (val === Infinity || val === -Infinity) {
        return true;
    }

    if (typeof val == 'object') {
        warningType = (val instanceof Array ? 'array': 'object');
    } else if (typeof val == 'string' && !val.match(/^[\+\-]?\d/)) {
        warningType = 'string';
    }
    if (warningType) {
        throw new Error('Warning: is_infinite() expects parameter 1 to be double, ' + warningType + ' given');
    }

    return false;

END_JS
);
}
function __php__is_nan($val){

JS( <<< END_JS
    var warningType = '';

    if (typeof val == 'number' && isNaN(val)) {
        return true;
    }

    if (typeof val == 'object') {
        warningType = (val instanceof Array ? 'array': 'object');
    } else if (typeof val == 'string' && !val.match(/^[\+\-]?\d/)) {
        warningType = 'string';
    }
    if (warningType) {
        throw new Error('Warning: is_nan() expects parameter 1 to be double, ' + warningType + ' given');
    }

    return false;

END_JS
);
}
function __php__lcg_value(){

JS( <<< END_JS
    return Math.random();

END_JS
);
}
function __php__log($arg,$base){

JS( <<< END_JS
    if (base === undefined) {
        return Math.log(arg);
    } else {
        return Math.log(arg) / Math.log(base);
    }

END_JS
);
}
function __php__log10($arg){

JS( <<< END_JS
    return Math.log(arg) / Math.LN10;

END_JS
);
}
function __php__max(){

JS( <<< END_JS
    var ar,
    retVal,
    i = 0,
    n = 0;
    var argv = arguments,
    argc = argv.length;

    var _obj2Array = function(obj) {
        if (obj instanceof Array) {
            return obj;
        } else {
            var ar = [];
            for (var i in obj) {
                ar.push(obj[i]);
            }
            return ar;
        }
    }
    var _compare = function(current, next) {
        var i = 0,
        n = 0,
        tmp = 0;
        var nl = 0,
        cl = 0;

        if (current === next) {
            return 0;
        } else if (typeof current == 'object') {
            if (typeof next == 'object') {
                current = _obj2Array(current);
                next = _obj2Array(next);
                cl = current.length;
                nl = next.length;
                if (nl > cl) {
                    return 1;
                } else if (nl < cl) {
                    return - 1;
                } else {
                    for (i = 0, n = cl; i < n; ++i) {
                        tmp = _compare(current[i], next[i]);
                        if (tmp == 1) {
                            return 1;
                        } else if (tmp == -1) {
                            return - 1;
                        }
                    }
                    return 0;
                }
            } else {
                return - 1;
            }
        } else if (typeof next == 'object') {
            return 1;
        } else if (isNaN(next) && !isNaN(current)) {
            if (current == 0) {
                return 0;
            } else {
                return (current < 0 ? 1: -1);
            }
        } else if (isNaN(current) && !isNaN(next)) {
            if (next == 0) {
                return 0;
            } else {
                return (next > 0 ? 1: -1);
            }
        } else {
            if (next == current) {
                return 0;
            } else {
                return (next > current ? 1: -1);
            }
        }
    }
    if (argc == 0) {
        throw new Error('At least one value should be passed to max()');
    } else if (argc == 1) {
        if (typeof argv[0] == 'object') {
            ar = _obj2Array(argv[0]);
        } else {
            throw new Error('Wrong parameter count for max()');
        }
        if (ar.length == 0) {
            throw new Error('Array must contain at least one element for max()');
        }
    } else {
        ar = argv;
    }

    retVal = ar[0];
    for (i = 1, n = ar.length; i < n; ++i) {
        if (_compare(retVal, ar[i]) == 1) {
            retVal = ar[i];
        }
    }

    return retVal;

END_JS
);
}
function __php__min(){

JS( <<< END_JS
    var ar,
    retVal,
    i = 0,
    n = 0;
    var argv = arguments,
    argc = argv.length;

    var _obj2Array = function(obj) {
        if (obj instanceof Array) {
            return obj;
        } else {
            var ar = [];
            for (var i in obj) {
                ar.push(obj[i]);
            }
            return ar;
        }
    }
    var _compare = function(current, next) {
        var i = 0,
        n = 0,
        tmp = 0;
        var nl = 0,
        cl = 0;

        if (current === next) {
            return 0;
        } else if (typeof current == 'object') {
            if (typeof next == 'object') {
                current = _obj2Array(current);
                next = _obj2Array(next);
                cl = current.length;
                nl = next.length;
                if (nl > cl) {
                    return 1;
                } else if (nl < cl) {
                    return - 1;
                } else {
                    for (i = 0, n = cl; i < n; ++i) {
                        tmp = _compare(current[i], next[i]);
                        if (tmp == 1) {
                            return 1;
                        } else if (tmp == -1) {
                            return - 1;
                        }
                    }
                    return 0;
                }
            } else {
                return - 1;
            }
        } else if (typeof next == 'object') {
            return 1;
        } else if (isNaN(next) && !isNaN(current)) {
            if (current == 0) {
                return 0;
            } else {
                return (current < 0 ? 1: -1);
            }
        } else if (isNaN(current) && !isNaN(next)) {
            if (next == 0) {
                return 0;
            } else {
                return (next > 0 ? 1: -1);
            }
        } else {
            if (next == current) {
                return 0;
            } else {
                return (next > current ? 1: -1);
            }
        }
    }
    if (argc == 0) {
        throw new Error('At least one value should be passed to min()');
    } else if (argc == 1) {
        if (typeof argv[0] == 'object') {
            ar = _obj2Array(argv[0]);
        } else {
            throw new Error('Wrong parameter count for min()');
        }
        if (ar.length == 0) {
            throw new Error('Array must contain at least one element for min()');
        }
    } else {
        ar = argv;
    }

    retVal = ar[0];
    for (i = 1, n = ar.length; i < n; ++i) {
        if (_compare(retVal, ar[i]) == -1) {
            retVal = ar[i];
        }
    }

    return retVal;

END_JS
);
}
function __php__mt_getrandmax()
{

JS( <<< END_JS
    return 2147483647;

END_JS
);
}
function __php__mt_rand($min,$max){

JS( <<< END_JS
    var argc = arguments.length;
    if (argc == 0) {
        min = 0;
        max = 2147483647;
    } else if (argc == 1) {
        throw new Error('Warning: mt_rand() expects exactly 2 parameters, 1 given');
    }
    return Math.floor(Math.random() * (max - min + 1)) + min;

END_JS
);
}
function __php__octdec($oct_string){

JS( <<< END_JS
    oct_string = (oct_string + '').replace(/[^0-7]/gi, '');
    return parseInt(oct_string, 8);

END_JS
);
}
function __php__pi(){

JS( <<< END_JS
    return Math.PI;

END_JS
);
}
function __php__pow($base,$exp){

JS( <<< END_JS
    return Math.pow(base, exp);

END_JS
);
}
function __php__rad2deg($angle){

JS( <<< END_JS
    return (angle / Math.PI) * 180;

END_JS
);
}
function __php__rand($min,$max){

JS( <<< END_JS
    var argc = arguments.length;
    if (argc == 0) {
        min = 0;
        max = 2147483647;
    } else if (argc == 1) {
        throw new Error('Warning: rand() expects exactly 2 parameters, 1 given');
    }
    return Math.floor(Math.random() * (max - min + 1)) + min;

END_JS
);
}
function __php__round($val,$precision){

JS( <<< END_JS
    return parseFloat(parseFloat(val).toFixed(precision));

END_JS
);
}
function __php__sin($arg){

JS( <<< END_JS
    return Math.sin(arg);

END_JS
);
}
function __php__sinh($arg){

JS( <<< END_JS
    return (Math.exp(arg) - Math.exp( - arg)) / 2;

END_JS
);
}
function __php__sqrt($arg){

JS( <<< END_JS
    return Math.sqrt(arg);

END_JS
);
}
function __php__tan($arg){

JS( <<< END_JS
    return Math.tan(arg);

END_JS
);
}
function __php__tanh($arg){

JS( <<< END_JS
    return (Math.exp(arg) - Math.exp( - arg)) / (Math.exp(arg) + Math.exp( - arg));

END_JS
);
}
function __php__constant($name){

JS( <<< END_JS
    if (window[name] === undefined) {
        return null;
    }

    return window[name];

END_JS
);
}
function __php__define($name,$value){

JS( <<< END_JS
    if (/boolean|number|null|string/.test(typeof value) !== true) {
        return false;
    }

    return (window[name] = value) !== undefined;

END_JS
);
}
function __php__defined($constant_name){

JS( <<< END_JS
    return (typeof window[constant_name] !== 'undefined');

END_JS
);
}
function __php__sleep($seconds){

JS( <<< END_JS
    seconds *= 1000;
    var start = new Date().getTime();
    while (new Date().getTime() < start + seconds);

    return 0;

END_JS
);
}
function __php__ip2long($ip_address){

JS( <<< END_JS
    var output = false;

    if (ip_address.match(/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\$/)) {
        var parts = ip_address.split('.');
        var output = 0;

        output = (parts[0] * Math.pow(256, 3)) +
        (parts[1] * Math.pow(256, 2)) +
        (parts[2] * Math.pow(256, 1)) +
        (parts[3] * Math.pow(256, 0));
    }

    return output;

END_JS
);
}
function __php__long2ip($proper_address){

JS( <<< END_JS
    var output = false;

    if (!isNaN(proper_address) && (proper_address >= 0 || proper_address <= 4294967295)) {
        output = Math.floor(proper_address / Math.pow(256, 3)) + '.' +
        Math.floor((proper_address % Math.pow(256, 3)) / Math.pow(256, 2)) + '.' +
        Math.floor(((proper_address % Math.pow(256, 3)) % Math.pow(256, 2)) / Math.pow(256, 1)) + '.' +
        Math.floor((((proper_address % Math.pow(256, 3)) % Math.pow(256, 2)) % Math.pow(256, 1)) / Math.pow(256, 0));
    }

    return output;

END_JS
);
}
function __php__setcookie($name,$value,$expires,$path,$domain,$secure){

JS( <<< END_JS
    expires instanceof Date ? expires = expires.toGMTString() : typeof(expires) == 'number' && (expires = (new Date( + (new Date) + expires * 1e3)).toGMTString());
    var r = [name + "=" + encodeURIComponent(value)],
    s,
    i;
    for (i in s = {
        expires: expires,
        path: path,
        domain: domain
    }) {
        s[i] && r.push(i + "=" + s[i]);
    }
    return secure && r.push("secure"),
    document.cookie = r.join(";"),
    true;

END_JS
);
}
function __php__preg_quote($str){

JS( <<< END_JS
    return (str + '').replace(/([\\\.\+\*\?\[\^\]\\$\(\)\{\}\=\!\<\>\|\:])/g, "\\\$1");

END_JS
);
}
function __php__addslashes($str){

JS( <<< END_JS
    return (str + '').replace(/([\\"'])/g, "\\\$1").replace(/\0/g, "\\0");

END_JS
);
}
function __php__bin2hex($s){

JS( <<< END_JS
    var v,
    i,
    f = 0,
    a = [];
    s += '';
    f = s.length;

    for (i = 0; i < f; i++) {
        a[i] = s.charCodeAt(i).toString(16).replace(/^([\da-f])\$/, "0\$1");
    }

    return a.join('');

END_JS
);
}
function __php__chop($str,$charlist){

JS( <<< END_JS
    return rtrim(str, charlist);

END_JS
);
}
function __php__chr($ascii){

JS( <<< END_JS
    return String.fromCharCode(ascii);

END_JS
);
}
function __php__count_chars($str,$mode){

JS( <<< END_JS
    var histogram = new Object(),
    tmp_arr = new Array();
    var key,
    i,
    code,
    mode,
    strl = 0;
    var argc = arguments.length;

    if (argc == 1) {
        mode = 0;
    }

    mode_even = (mode & 1) == 0;
    if (mode_even) {
        for (i = 1; i < 256; ++i) {
            histogram[i] = 0;
        }
    }

    str += '';

    strl = str.length;
    for (i = 0; i < strl; ++i) {
        code = str.charCodeAt(i);
        if (code in histogram) {
            ++histogram[code];
        } else {
            histogram[code] = 1;
        }
    }

    if (mode > 0) {
        for (key in histogram) {
            if (histogram[key] == 0 != mode_even) {
                delete histogram[key];
            }
        }
    }

    if (mode < 3) {
        return histogram;
    } else {
        for (key in histogram) {
            tmp_arr.push(String.fromCharCode(key));
        }
        return tmp_arr.join("");
    }

END_JS
);
}
function __php__crc32($str){

JS( <<< END_JS
    str = utf8_encode(str);
    var table = "00000000 77073096 EE0E612C 990951BA 076DC419 706AF48F E963A535 9E6495A3 0EDB8832 79DCB8A4 E0D5E91E 97D2D988 09B64C2B 7EB17CBD E7B82D07 90BF1D91 1DB71064 6AB020F2 F3B97148 84BE41DE 1ADAD47D 6DDDE4EB F4D4B551 83D385C7 136C9856 646BA8C0 FD62F97A 8A65C9EC 14015C4F 63066CD9 FA0F3D63 8D080DF5 3B6E20C8 4C69105E D56041E4 A2677172 3C03E4D1 4B04D447 D20D85FD A50AB56B 35B5A8FA 42B2986C DBBBC9D6 ACBCF940 32D86CE3 45DF5C75 DCD60DCF ABD13D59 26D930AC 51DE003A C8D75180 BFD06116 21B4F4B5 56B3C423 CFBA9599 B8BDA50F 2802B89E 5F058808 C60CD9B2 B10BE924 2F6F7C87 58684C11 C1611DAB B6662D3D 76DC4190 01DB7106 98D220BC EFD5102A 71B18589 06B6B51F 9FBFE4A5 E8B8D433 7807C9A2 0F00F934 9609A88E E10E9818 7F6A0DBB 086D3D2D 91646C97 E6635C01 6B6B51F4 1C6C6162 856530D8 F262004E 6C0695ED 1B01A57B 8208F4C1 F50FC457 65B0D9C6 12B7E950 8BBEB8EA FCB9887C 62DD1DDF 15DA2D49 8CD37CF3 FBD44C65 4DB26158 3AB551CE A3BC0074 D4BB30E2 4ADFA541 3DD895D7 A4D1C46D D3D6F4FB 4369E96A 346ED9FC AD678846 DA60B8D0 44042D73 33031DE5 AA0A4C5F DD0D7CC9 5005713C 270241AA BE0B1010 C90C2086 5768B525 206F85B3 B966D409 CE61E49F 5EDEF90E 29D9C998 B0D09822 C7D7A8B4 59B33D17 2EB40D81 B7BD5C3B C0BA6CAD EDB88320 9ABFB3B6 03B6E20C 74B1D29A EAD54739 9DD277AF 04DB2615 73DC1683 E3630B12 94643B84 0D6D6A3E 7A6A5AA8 E40ECF0B 9309FF9D 0A00AE27 7D079EB1 F00F9344 8708A3D2 1E01F268 6906C2FE F762575D 806567CB 196C3671 6E6B06E7 FED41B76 89D32BE0 10DA7A5A 67DD4ACC F9B9DF6F 8EBEEFF9 17B7BE43 60B08ED5 D6D6A3E8 A1D1937E 38D8C2C4 4FDFF252 D1BB67F1 A6BC5767 3FB506DD 48B2364B D80D2BDA AF0A1B4C 36034AF6 41047A60 DF60EFC3 A867DF55 316E8EEF 4669BE79 CB61B38C BC66831A 256FD2A0 5268E236 CC0C7795 BB0B4703 220216B9 5505262F C5BA3BBE B2BD0B28 2BB45A92 5CB36A04 C2D7FFA7 B5D0CF31 2CD99E8B 5BDEAE1D 9B64C2B0 EC63F226 756AA39C 026D930A 9C0906A9 EB0E363F 72076785 05005713 95BF4A82 E2B87A14 7BB12BAE 0CB61B38 92D28E9B E5D5BE0D 7CDCEFB7 0BDBDF21 86D3D2D4 F1D4E242 68DDB3F8 1FDA836E 81BE16CD F6B9265B 6FB077E1 18B74777 88085AE6 FF0F6A70 66063BCA 11010B5C 8F659EFF F862AE69 616BFFD3 166CCF45 A00AE278 D70DD2EE 4E048354 3903B3C2 A7672661 D06016F7 4969474D 3E6E77DB AED16A4A D9D65ADC 40DF0B66 37D83BF0 A9BCAE53 DEBB9EC5 47B2CF7F 30B5FFE9 BDBDF21C CABAC28A 53B39330 24B4A3A6 BAD03605 CDD70693 54DE5729 23D967BF B3667A2E C4614AB8 5D681B02 2A6F2B94 B40BBE37 C30C8EA1 5A05DF1B 2D02EF8D";

    var crc = 0;
    var x = 0;
    var y = 0;

    crc = crc ^ ( - 1);
    for (var i = 0, iTop = str.length; i < iTop; i++) {
        y = (crc ^ str.charCodeAt(i)) & 0xFF;
        x = "0x" + table.substr(y * 9, 8);
        crc = (crc >>> 8) ^ x;
    }

    return crc ^ ( - 1);

END_JS
);
}
function __php__echo(){

JS( <<< END_JS
    var arg = '',
    argc = arguments.length,
    argv = arguments,
    i = 0;
    var bodies = [],
    body,
    elmt;

    bodies = document.getElementsByTagName("body");
    if (!bodies || !bodies[0]) {
        return false;
    }
    body = bodies[0];

    for (i = 0; i < argc; i++) {
        arg = argv[i];
        if (document.createDocumentFragment && document.createTextNode && document.appendChild) {
            var docFragment = document.createDocumentFragment();
            var txt = document.createTextNode(arg);
            docFragment.appendChild(txt);
            document.body.appendChild(docFragment);
        } else if (document.write) {
            document.write(arg);
        } else {
            print(arg);
        }
    }

    return null;

END_JS
);
}
function __php__explode($delimiter,$string,$limit){

JS( <<< END_JS
    var emptyArray = {
        0: ''
    };

    if (arguments.length < 2
    || typeof arguments[0] == 'undefined'
    || typeof arguments[1] == 'undefined')
    {
        return null;
    }

    if (delimiter === ''
    || delimiter === false
    || delimiter === null)
    {
        return false;
    }

    if (typeof delimiter == 'function'
    || typeof delimiter == 'object'
    || typeof string == 'function'
    || typeof string == 'object')
    {
        return emptyArray;
    }

    if (delimiter === true) {
        delimiter = '1';
    }

    if (!limit) {
        return string.toString().split(delimiter.toString());
    } else {
        var splitted = string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;
    }

END_JS
);
}
function __php__get_html_translation_table($table,$quote_style){

JS( <<< END_JS
    var entities = {},
    histogram = {},
    decimal = 0,
    symbol = '';
    var constMappingTable = {},
    constMappingQuoteStyle = {};
    var useTable = {},
    useQuoteStyle = {};

    useTable = (table ? table.toUpperCase() : 'HTML_SPECIALCHARS');
    useQuoteStyle = (quote_style ? quote_style.toUpperCase() : 'ENT_COMPAT');

    constMappingTable[0] = 'HTML_SPECIALCHARS';
    constMappingTable[1] = 'HTML_ENTITIES';
    constMappingQuoteStyle[0] = 'ENT_NOQUOTES';
    constMappingQuoteStyle[2] = 'ENT_COMPAT';
    constMappingQuoteStyle[3] = 'ENT_QUOTES';

    if (!isNaN(useTable)) {
        useTable = constMappingTable[useTable];
    }
    if (!isNaN(useQuoteStyle)) {
        useQuoteStyle = constMappingQuoteStyle[useQuoteStyle];
    }

    if (useTable == 'HTML_SPECIALCHARS') {
        entities['38'] = '&amp;';
        entities['60'] = '&lt;';
        entities['62'] = '&gt;';
    } else if (useTable == 'HTML_ENTITIES') {
        entities['38'] = '&amp;';
        entities['60'] = '&lt;';
        entities['62'] = '&gt;';
        entities['160'] = '&nbsp;';
        entities['161'] = '&iexcl;';
        entities['162'] = '&cent;';
        entities['163'] = '&pound;';
        entities['164'] = '&curren;';
        entities['165'] = '&yen;';
        entities['166'] = '&brvbar;';
        entities['167'] = '&sect;';
        entities['168'] = '&uml;';
        entities['169'] = '&copy;';
        entities['170'] = '&ordf;';
        entities['171'] = '&laquo;';
        entities['172'] = '&not;';
        entities['173'] = '&shy;';
        entities['174'] = '&reg;';
        entities['175'] = '&macr;';
        entities['176'] = '&deg;';
        entities['177'] = '&plusmn;';
        entities['178'] = '&sup2;';
        entities['179'] = '&sup3;';
        entities['180'] = '&acute;';
        entities['181'] = '&micro;';
        entities['182'] = '&para;';
        entities['183'] = '&middot;';
        entities['184'] = '&cedil;';
        entities['185'] = '&sup1;';
        entities['186'] = '&ordm;';
        entities['187'] = '&raquo;';
        entities['188'] = '&frac14;';
        entities['189'] = '&frac12;';
        entities['190'] = '&frac34;';
        entities['191'] = '&iquest;';
        entities['192'] = '&Agrave;';
        entities['193'] = '&Aacute;';
        entities['194'] = '&Acirc;';
        entities['195'] = '&Atilde;';
        entities['196'] = '&Auml;';
        entities['197'] = '&Aring;';
        entities['198'] = '&AElig;';
        entities['199'] = '&Ccedil;';
        entities['200'] = '&Egrave;';
        entities['201'] = '&Eacute;';
        entities['202'] = '&Ecirc;';
        entities['203'] = '&Euml;';
        entities['204'] = '&Igrave;';
        entities['205'] = '&Iacute;';
        entities['206'] = '&Icirc;';
        entities['207'] = '&Iuml;';
        entities['208'] = '&ETH;';
        entities['209'] = '&Ntilde;';
        entities['210'] = '&Ograve;';
        entities['211'] = '&Oacute;';
        entities['212'] = '&Ocirc;';
        entities['213'] = '&Otilde;';
        entities['214'] = '&Ouml;';
        entities['215'] = '&times;';
        entities['216'] = '&Oslash;';
        entities['217'] = '&Ugrave;';
        entities['218'] = '&Uacute;';
        entities['219'] = '&Ucirc;';
        entities['220'] = '&Uuml;';
        entities['221'] = '&Yacute;';
        entities['222'] = '&THORN;';
        entities['223'] = '&szlig;';
        entities['224'] = '&agrave;';
        entities['225'] = '&aacute;';
        entities['226'] = '&acirc;';
        entities['227'] = '&atilde;';
        entities['228'] = '&auml;';
        entities['229'] = '&aring;';
        entities['230'] = '&aelig;';
        entities['231'] = '&ccedil;';
        entities['232'] = '&egrave;';
        entities['233'] = '&eacute;';
        entities['234'] = '&ecirc;';
        entities['235'] = '&euml;';
        entities['236'] = '&igrave;';
        entities['237'] = '&iacute;';
        entities['238'] = '&icirc;';
        entities['239'] = '&iuml;';
        entities['240'] = '&eth;';
        entities['241'] = '&ntilde;';
        entities['242'] = '&ograve;';
        entities['243'] = '&oacute;';
        entities['244'] = '&ocirc;';
        entities['245'] = '&otilde;';
        entities['246'] = '&ouml;';
        entities['247'] = '&divide;';
        entities['248'] = '&oslash;';
        entities['249'] = '&ugrave;';
        entities['250'] = '&uacute;';
        entities['251'] = '&ucirc;';
        entities['252'] = '&uuml;';
        entities['253'] = '&yacute;';
        entities['254'] = '&thorn;';
        entities['255'] = '&yuml;';
    } else {
        throw Error("Table: " + useTable + ' not supported');
        return false;
    }

    if (useQuoteStyle != 'ENT_NOQUOTES') {
        entities['34'] = '&quot;';
    }

    if (useQuoteStyle == 'ENT_QUOTES') {
        entities['39'] = '&#039;';
    }

    for (decimal in entities) {
        symbol = String.fromCharCode(decimal)
        histogram[symbol] = entities[decimal];
    }

    return histogram;

END_JS
);
}
function __php__html_entity_decode($string,$quote_style){

JS( <<< END_JS
    var histogram = {},
    symbol = '',
    tmp_str = '',
    i = 0;
    tmp_str = string.toString();

    if (false === (histogram = get_html_translation_table('HTML_ENTITIES', quote_style))) {
        return false;
    }

    for (symbol in histogram) {
        entity = histogram[symbol];
        tmp_str = tmp_str.split(entity).join(symbol);
    }

    return tmp_str;

END_JS
);
}
function __php__htmlentities($string,$quote_style){

JS( <<< END_JS
    var histogram = {},
    symbol = '',
    tmp_str = '',
    i = 0;
    tmp_str = string.toString();

    if (false === (histogram = get_html_translation_table('HTML_ENTITIES', quote_style))) {
        return false;
    }

    for (symbol in histogram) {
        entity = histogram[symbol];
        tmp_str = tmp_str.split(symbol).join(entity);
    }

    return tmp_str;

END_JS
);
}
function __php__htmlspecialchars($string,$quote_style){

JS( <<< END_JS
    var histogram = {},
    symbol = '',
    tmp_str = '',
    i = 0;
    tmp_str = string.toString();

    if (false === (histogram = get_html_translation_table('HTML_SPECIALCHARS', quote_style))) {
        return false;
    }

    for (symbol in histogram) {
        entity = histogram[symbol];
        tmp_str = tmp_str.split(symbol).join(entity);
    }

    return tmp_str;

END_JS
);
}
function __php__htmlspecialchars_decode($string,$quote_style){

JS( <<< END_JS
    var histogram = {},
    symbol = '',
    tmp_str = '',
    i = 0;
    tmp_str = string.toString();

    if (false === (histogram = get_html_translation_table('HTML_SPECIALCHARS', quote_style))) {
        return false;
    }

    for (symbol in histogram) {
        entity = histogram[symbol];
        tmp_str = tmp_str.split(entity).join(symbol);
    }

    return tmp_str;

END_JS
);
}
function __php__implode($glue,$pieces){

JS( <<< END_JS
    return ((pieces instanceof Array) ? pieces.join(glue) : pieces);

END_JS
);
}
function __php__join($glue,$pieces){

JS( <<< END_JS
    return implode(glue, pieces);

END_JS
);
}
function __php__levenshtein($str1,$str2){

JS( <<< END_JS
    var s,
    l = (s = (str1 + '').split("")).length,
    t = (str2 = (str2 + '').split("")).length,
    i,
    j,
    m,
    n;
    if (! (l || t)) return Math.max(l, t);
    for (var a = [], i = l + 1; i; a[--i] = [i]);
    for (i = t + 1; a[0][--i] = i;);
    for (i = -1, m = s.length; ++i < m;) {
        for (j = -1, n = str2.length; ++j < n;) {
            a[(i *= 1) + 1][(j *= 1) + 1] = Math.min(a[i][j + 1] + 1, a[i + 1][j] + 1, a[i][j] + (s[i] != str2[j]));
        }
    }
    return a[l][t];

END_JS
);
}
function __php__ltrim($str,$charlist){

JS( <<< END_JS
    charlist = !charlist ? ' \s\xA0': (charlist + '').replace(/([\[\]\(\)\.\?\/\*\{\}\+\\$\^\:])/g, '\\$1');
    var re = new RegExp('^[' + charlist + ']+', 'g');
    return (str + '').replace(re, '');

END_JS
);
}
function __php__md5($str){

JS( <<< END_JS
    var RotateLeft = function(lValue, iShiftBits) {
        return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
    };

    var AddUnsigned = function(lX, lY) {
        var lX4,
        lY4,
        lX8,
        lY8,
        lResult;
        lX8 = (lX & 0x80000000);
        lY8 = (lY & 0x80000000);
        lX4 = (lX & 0x40000000);
        lY4 = (lY & 0x40000000);
        lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
        if (lX4 & lY4) {
            return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
        }
        if (lX4 | lY4) {
            if (lResult & 0x40000000) {
                return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
            } else {
                return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
            }
        } else {
            return (lResult ^ lX8 ^ lY8);
        }
    };

    var F = function(x, y, z) {
        return (x & y) | ((~x) & z);
    };
    var G = function(x, y, z) {
        return (x & z) | (y & (~z));
    };
    var H = function(x, y, z) {
        return (x ^ y ^ z);
    };
    var I = function(x, y, z) {
        return (y ^ (x | (~z)));
    };

    var FF = function(a, b, c, d, x, s, ac) {
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
        return AddUnsigned(RotateLeft(a, s), b);
    };

    var GG = function(a, b, c, d, x, s, ac) {
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
        return AddUnsigned(RotateLeft(a, s), b);
    };

    var HH = function(a, b, c, d, x, s, ac) {
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
        return AddUnsigned(RotateLeft(a, s), b);
    };

    var II = function(a, b, c, d, x, s, ac) {
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
        return AddUnsigned(RotateLeft(a, s), b);
    };

    var ConvertToWordArray = function(str) {
        var lWordCount;
        var lMessageLength = str.length;
        var lNumberOfWords_temp1 = lMessageLength + 8;
        var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - (lNumberOfWords_temp1 % 64)) / 64;
        var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
        var lWordArray = Array(lNumberOfWords - 1);
        var lBytePosition = 0;
        var lByteCount = 0;
        while (lByteCount < lMessageLength) {
            lWordCount = (lByteCount - (lByteCount % 4)) / 4;
            lBytePosition = (lByteCount % 4) * 8;
            lWordArray[lWordCount] = (lWordArray[lWordCount] | (str.charCodeAt(lByteCount) << lBytePosition));
            lByteCount++;
        }
        lWordCount = (lByteCount - (lByteCount % 4)) / 4;
        lBytePosition = (lByteCount % 4) * 8;
        lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
        lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
        lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
        return lWordArray;
    };

    var WordToHex = function(lValue) {
        var WordToHexValue = "",
        WordToHexValue_temp = "",
        lByte,
        lCount;
        for (lCount = 0; lCount <= 3; lCount++) {
            lByte = (lValue >>> (lCount * 8)) & 255;
            WordToHexValue_temp = "0" + lByte.toString(16);
            WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length - 2, 2);
        }
        return WordToHexValue;
    };

    var x = Array();
    var k,
    AA,
    BB,
    CC,
    DD,
    a,
    b,
    c,
    d;
    var S11 = 7,
    S12 = 12,
    S13 = 17,
    S14 = 22;
    var S21 = 5,
    S22 = 9,
    S23 = 14,
    S24 = 20;
    var S31 = 4,
    S32 = 11,
    S33 = 16,
    S34 = 23;
    var S41 = 6,
    S42 = 10,
    S43 = 15,
    S44 = 21;

    str = utf8_encode(str);
    x = ConvertToWordArray(str);
    a = 0x67452301;
    b = 0xEFCDAB89;
    c = 0x98BADCFE;
    d = 0x10325476;

    xl = x.length;
    for (k = 0; k < xl; k += 16) {
        AA = a;
        BB = b;
        CC = c;
        DD = d;
        a = FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
        d = FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
        c = FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
        b = FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
        a = FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
        d = FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
        c = FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
        b = FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
        a = FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
        d = FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
        c = FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
        b = FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
        a = FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
        d = FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
        c = FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
        b = FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
        a = GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
        d = GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
        c = GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
        b = GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
        a = GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
        d = GG(d, a, b, c, x[k + 10], S22, 0x2441453);
        c = GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
        b = GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
        a = GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
        d = GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
        c = GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
        b = GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
        a = GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
        d = GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
        c = GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
        b = GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
        a = HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
        d = HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
        c = HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
        b = HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
        a = HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
        d = HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
        c = HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
        b = HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
        a = HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
        d = HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
        c = HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
        b = HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
        a = HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
        d = HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
        c = HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
        b = HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
        a = II(a, b, c, d, x[k + 0], S41, 0xF4292244);
        d = II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
        c = II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
        b = II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
        a = II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
        d = II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
        c = II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
        b = II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
        a = II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
        d = II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
        c = II(c, d, a, b, x[k + 6], S43, 0xA3014314);
        b = II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
        a = II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
        d = II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
        c = II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
        b = II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
        a = AddUnsigned(a, AA);
        b = AddUnsigned(b, BB);
        c = AddUnsigned(c, CC);
        d = AddUnsigned(d, DD);
    }

    var temp = WordToHex(a) + WordToHex(b) + WordToHex(c) + WordToHex(d);

    return temp.toLowerCase();

END_JS
);
}
function __php__md5_file($str_filename){

JS( <<< END_JS
    buf = file_get_contents(str_filename);

    if (!buf) {
        return false;
    }

    return md5(buf);

END_JS
);
}
function __php__nl2br($str,$is_xhtml){

JS( <<< END_JS
    breakTag = '<br />';
    if (typeof is_xhtml != 'undefined' && !is_xhtml) {
        breakTag = '<br>';
    }

    return (str + '').replace(/([^>]?)\n/g, '\$1' + breakTag + '\n');

END_JS
);
}
function __php__number_format($number,$decimals,$dec_point,$thousands_sep){

JS( <<< END_JS
    var n = number,
    c = isNaN(decimals = Math.abs(decimals)) ? 2: decimals;
    var d = dec_point == undefined ? ".": dec_point;
    var t = thousands_sep == undefined ? ",": thousands_sep,
    s = n < 0 ? "-": "";
    var i = parseInt(n = Math.abs( + n || 0).toFixed(c)) + "",
    j = (j = i.length) > 3 ? j % 3: 0;

    return s + (j ? i.substr(0, j) + t: "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "\$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");

END_JS
);
}
function __php__ord($string){

JS( <<< END_JS
    return (string + '').charCodeAt(0);

END_JS
);
}
function __php__parse_str($str,$array){

JS( <<< END_JS
    var glue1 = '=';
    var glue2 = '&';

    var array2 = (str + '').split(glue2);
    var array3 = [];
    var array2l = 0,
    tmp = '',
    x = 0;

    array2l = array2.length;
    for (x = 0; x < array2l; x++) {
        tmp = array2[x].split(glue1);
        array3[unescape(tmp[0])] = unescape(tmp[1]).replace(/[+]/g, ' ');
    }

    if (array) {
        array = array3;
    } else {
        return array3;
    }

END_JS
);
}
function __php__printf(){

JS( <<< END_JS
    var bodies = [],
    body,
    elmt;
    var ret = '';

    bodies = document.getElementsByTagName("body");
    if (!bodies || !bodies[0]) {
        return false;
    }
    body = bodies[0];


    ret = sprintf.apply(this, arguments);

    elmt = document.createTextNode(ret);
    body.appendChild(elmt);

    return ret.length;

END_JS
);
}
function __php__quotemeta($str){

JS( <<< END_JS
    return (str + '').replace(/([\.\\\+\*\?\[\^\]\\$\(\)])/g, '\\\$1');

END_JS
);
}
function __php__rtrim($str,$charlist){

JS( <<< END_JS
    charlist = !charlist ? ' \s\xA0': (charlist + '').replace(/([\[\]\(\)\.\?\/\*\{\}\+\\$\^\:])/g, '\\$1');
    var re = new RegExp('[' + charlist + ']+\$', 'g');
    return (str + '').replace(re, '');

END_JS
);
}
function __php__sha1($str){

JS( <<< END_JS
    var rotate_left = function(n, s) {
        var t4 = (n << s) | (n >>> (32 - s));
        return t4;
    };

    var lsb_hex = function(val) {
        var str = "";
        var i;
        var vh;
        var vl;

        for (i = 0; i <= 6; i += 2) {
            vh = (val >>> (i * 4 + 4)) & 0x0f;
            vl = (val >>> (i * 4)) & 0x0f;
            str += vh.toString(16) + vl.toString(16);
        }
        return str;
    };

    var cvt_hex = function(val) {
        var str = "";
        var i;
        var v;

        for (i = 7; i >= 0; i--) {
            v = (val >>> (i * 4)) & 0x0f;
            str += v.toString(16);
        }
        return str;
    };

    var blockstart;
    var i,
    j;
    var W = new Array(80);
    var H0 = 0x67452301;
    var H1 = 0xEFCDAB89;
    var H2 = 0x98BADCFE;
    var H3 = 0x10325476;
    var H4 = 0xC3D2E1F0;
    var A,
    B,
    C,
    D,
    E;
    var temp;

    str = utf8_encode(str);
    var str_len = str.length;

    var word_array = new Array();
    for (i = 0; i < str_len - 3; i += 4) {
        j = str.charCodeAt(i) << 24 | str.charCodeAt(i + 1) << 16 |
        str.charCodeAt(i + 2) << 8 | str.charCodeAt(i + 3);
        word_array.push(j);
    }

    switch (str_len % 4) {
    case 0:
        i = 0x080000000;
        break;
    case 1:
        i = str.charCodeAt(str_len - 1) << 24 | 0x0800000;
        break;
    case 2:
        i = str.charCodeAt(str_len - 2) << 24 | str.charCodeAt(str_len - 1) << 16 | 0x08000;
        break;
    case 3:
        i = str.charCodeAt(str_len - 3) << 24 | str.charCodeAt(str_len - 2) << 16 | str.charCodeAt(str_len - 1) << 8 | 0x80;
        break;
    }

    word_array.push(i);

    while ((word_array.length % 16) != 14) word_array.push(0);

    word_array.push(str_len >>> 29);
    word_array.push((str_len << 3) & 0x0ffffffff);

    for (blockstart = 0; blockstart < word_array.length; blockstart += 16) {
        for (i = 0; i < 16; i++) W[i] = word_array[blockstart + i];
        for (i = 16; i <= 79; i++) W[i] = rotate_left(W[i - 3] ^ W[i - 8] ^ W[i - 14] ^ W[i - 16], 1);

        A = H0;
        B = H1;
        C = H2;
        D = H3;
        E = H4;

        for (i = 0; i <= 19; i++) {
            temp = (rotate_left(A, 5) + ((B & C) | (~B & D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
        }

        for (i = 20; i <= 39; i++) {
            temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
        }

        for (i = 40; i <= 59; i++) {
            temp = (rotate_left(A, 5) + ((B & C) | (B & D) | (C & D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
        }

        for (i = 60; i <= 79; i++) {
            temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
        }

        H0 = (H0 + A) & 0x0ffffffff;
        H1 = (H1 + B) & 0x0ffffffff;
        H2 = (H2 + C) & 0x0ffffffff;
        H3 = (H3 + D) & 0x0ffffffff;
        H4 = (H4 + E) & 0x0ffffffff;
    }

    var temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
    return temp.toLowerCase();

END_JS
);
}
function __php__sha1_file($str_filename){

JS( <<< END_JS
    var buf = file_get_contents(str_filename);
    return sha1(buf);

END_JS
);
}
function __php__soundex($str){

JS( <<< END_JS
    var i,
    j,
    l,
    r,
    p = isNaN(p) ? 4: p > 10 ? 10: p < 4 ? 4: p;
    var m = {
        BFPV: 1,
        CGJKQSXZ: 2,
        DT: 3,
        L: 4,
        MN: 5,
        R: 6
    };
    var r = (s = (str + '').toUpperCase().replace(/[^A-Z]/g, "").split("")).splice(0, 1);
    var sl = 0;

    sl = s.length;
    for (i = -1, l = sl; ++i < l;) {
        for (j in m) {
            if (j.indexOf(s[i]) + 1 && r[r.length - 1] != m[j] && r.push(m[j])) {
                break;
            }
        }
    }

    return r.length > p && (r.length = p),
    r.join("") + (new Array(p - r.length + 1)).join("0");

END_JS
);
}
function __php__split($delimiter,$string){

JS( <<< END_JS
    return explode(delimiter, string);

END_JS
);
}
function __php__sprintf(){

JS( <<< END_JS
    var regex = /%%|%(\d+\\$)?([-+\'#0 ]*)(\*\d+\\$|\*|\d+)?(\.(\*\d+\\$|\*|\d+))?([scboxXuidfegEG])/g;
    var a = arguments,
    i = 0,
    format = a[i++];

    var pad = function(str, len, chr, leftJustify) {
        if (!chr) chr = ' ';
        var padding = (str.length >= len) ? '': Array(1 + len - str.length >>> 0).join(chr);
        return leftJustify ? str + padding: padding + str;
    };

    var justify = function(value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
        var diff = minWidth - value.length;
        if (diff > 0) {
            if (leftJustify || !zeroPad) {
                value = pad(value, minWidth, customPadChar, leftJustify);
            } else {
                value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
            }
        }
        return value;
    };

    var formatBaseX = function(value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
        var number = value >>> 0;
        prefix = prefix && number && {
            '2': '0b',
            '8': '0',
            '16': '0x'
        } [base] || '';
        value = prefix + pad(number.toString(base), precision || 0, '0', false);
        return justify(value, prefix, leftJustify, minWidth, zeroPad);
    };

    var formatString = function(value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
        if (precision != null) {
            value = value.slice(0, precision);
        }
        return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
    };

    var doFormat = function(substring, valueIndex, flags, minWidth, _, precision, type) {
        if (substring == '%%') return '%';

        var leftJustify = false,
        positivePrefix = '',
        zeroPad = false,
        prefixBaseX = false,
        customPadChar = ' ';
        var flagsl = flags.length;
        for (var j = 0; flags && j < flagsl; j++) switch (flags.charAt(j)) {
        case ' ':
            positivePrefix = ' ';
            break;
        case '+':
            positivePrefix = '+';
            break;
        case '-':
            leftJustify = true;
            break;
        case "'":
            customPadChar = flags.charAt(j + 1);
            break;
        case '0':
            zeroPad = true;
            break;
        case '#':
            prefixBaseX = true;
            break;
        }

        if (!minWidth) {
            minWidth = 0;
        } else if (minWidth == '*') {
            minWidth = +a[i++];
        } else if (minWidth.charAt(0) == '*') {
            minWidth = +a[minWidth.slice(1, -1)];
        } else {
            minWidth = +minWidth;
        }

        if (minWidth < 0) {
            minWidth = -minWidth;
            leftJustify = true;
        }

        if (!isFinite(minWidth)) {
            throw new Error('sprintf: (minimum-)width must be finite');
        }

        if (!precision) {
            precision = 'fFeE'.indexOf(type) > -1 ? 6: (type == 'd') ? 0: void(0);
        } else if (precision == '*') {
            precision = +a[i++];
        } else if (precision.charAt(0) == '*') {
            precision = +a[precision.slice(1, -1)];
        } else {
            precision = +precision;
        }

        var value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

        switch (type) {
        case 's':
            return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
        case 'c':
            return formatString(String.fromCharCode( + value), leftJustify, minWidth, precision, zeroPad);
        case 'b':
            return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'o':
            return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'x':
            return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'X':
            return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
        case 'u':
            return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'i':
        case 'd':
            {
                var number = parseInt( + value);
                var prefix = number < 0 ? '-': positivePrefix;
                value = prefix + pad(String(Math.abs(number)), precision, '0', false);
                return justify(value, prefix, leftJustify, minWidth, zeroPad);
            }
        case 'e':
        case 'E':
        case 'f':
        case 'F':
        case 'g':
        case 'G':
            {
                var number = +value;
                var prefix = number < 0 ? '-': positivePrefix;
                var method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
                var textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
                value = prefix + Math.abs(number)[method](precision);
                return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
            }
        default:
            return substring;
        }
    };

    return format.replace(regex, doFormat);

END_JS
);
}
function __php__str_ireplace($search,$replace,$subject){

JS( <<< END_JS
    var i,
    k = '';
    var searchl = 0;

    search += '';
    searchl = search.length;
    if (! (replace instanceof Array)) {
        replace = new Array(replace);
        if (search instanceof Array) {
            while (searchl > replace.length) {
                replace[replace.length] = replace[0];
            }
        }
    }

    if (! (search instanceof Array)) {
        search = new Array(search);
    }
    while (search.length > replace.length) {
        replace[replace.length] = '';
    }

    if (subject instanceof Array) {
        for (k in subject) {
            subject[k] = str_ireplace(search, replace, subject[k]);
        }
        return subject;
    }

    searchl = search.length;
    for (i = 0; i < searchl; i++) {
        reg = new RegExp(search[i], 'gi');
        subject = subject.replace(reg, replace[i]);
    }

    return subject;

END_JS
);
}
function __php__str_pad($input,$pad_length,$pad_string,$pad_type){

JS( <<< END_JS
    var half = '',
    pad_to_go;

    var str_pad_repeater = function(s, len) {
        var collect = '',
        i;

        while (collect.length < len) collect += s;
        collect = collect.substr(0, len);

        return collect;
    };

    input += '';

    if (pad_type != 'STR_PAD_LEFT' && pad_type != 'STR_PAD_RIGHT' && pad_type != 'STR_PAD_BOTH') {
        pad_type = 'STR_PAD_RIGHT';
    }
    if ((pad_to_go = pad_length - input.length) > 0) {
        if (pad_type == 'STR_PAD_LEFT') {
            input = str_pad_repeater(pad_string, pad_to_go) + input;
        }
        else if (pad_type == 'STR_PAD_RIGHT') {
            input = input + str_pad_repeater(pad_string, pad_to_go);
        }
        else if (pad_type == 'STR_PAD_BOTH') {
            half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
            input = half + input + half;
            input = input.substr(0, pad_length);
        }
    }

    return input;

END_JS
);
}
function __php__str_repeat($input,$multiplier){

JS( <<< END_JS

    return new Array(multiplier + 1).join(input);

END_JS
);
}
function __php__str_replace($search,$replace,$subject){

JS( <<< END_JS
    var f = search,
    r = replace,
    s = subject;
    var ra = r instanceof Array,
    sa = s instanceof Array,
    f = [].concat(f),
    r = [].concat(r),
    i = (s = [].concat(s)).length;

    while (j = 0, i--) {
        if (s[i]) {
            while (s[i] = (s[i] + '').split(f[j]).join(ra ? r[j] || "": r[0]), ++j in f) {};
        }
    };

    return sa ? s: s[0];

END_JS
);
}
function __php__str_rot13($str){

JS( <<< END_JS
    return (str + '').replace(/[A-Za-z]/g,
    function(c) {
        return String.fromCharCode((((c = c.charCodeAt(0)) & 223) - 52) % 26 + (c & 32) + 65);
    });

END_JS
);
}
function __php__str_split($f_string,$f_split_length){

JS( <<< END_JS
    f_string += '';

    if (f_split_length == undefined) {
        f_split_length = 1;
    }
    if (f_split_length > 0) {
        var result = [];
        while (f_string.length > f_split_length) {
            result[result.length] = f_string.substring(0, f_split_length);
            f_string = f_string.substring(f_split_length);
        }
        result[result.length] = f_string;
        return result;
    }
    return false;

END_JS
);
}
function __php__strcasecmp($f_string1,$f_string2){

JS( <<< END_JS
    var string1 = (f_string1 + '').toLowerCase();
    var string2 = (f_string2 + '').toLowerCase();

    if (string1 > string2) {
        return 1;
    }
    else if (string1 == string2) {
        return 0;
    }

    return - 1;

END_JS
);
}
function __php__strchr($haystack,$needle,$bool){

JS( <<< END_JS
    return strstr(haystack, needle, bool);

END_JS
);
}
function __php__strcmp($str1,$str2){

JS( <<< END_JS
    return ((str1 == str2) ? 0: ((str1 > str2) ? 1: -1));

END_JS
);
}
function __php__strip_tags($str,$allowed_tags){

JS( <<< END_JS
    var key = '',
    tag = '',
    allowed = false;
    var matches = allowed_array = [];

    var replacer = function(search, replace, str) {
        return str.split(search).join(replace);
    };

    if (allowed_tags) {
        allowed_array = allowed_tags.match(/([a-zA-Z]+)/gi);
    }

    str += '';

    matches = str.match(/(<\/?[^>]+>)/gi);

    for (key in matches) {
        if (isNaN(key)) {
            continue;
        }

        html = matches[key].toString();

        allowed = false;

        for (k in allowed_array) {
            allowed_tag = allowed_array[k];
            i = -1;

            if (i != 0) {
                i = html.toLowerCase().indexOf('<' + allowed_tag + '>');
            }
            if (i != 0) {
                i = html.toLowerCase().indexOf('<' + allowed_tag + ' ');
            }
            if (i != 0) {
                i = html.toLowerCase().indexOf('</' + allowed_tag);
            }

            if (i == 0) {
                allowed = true;
                break;
            }
        }

        if (!allowed) {
            str = replacer(html, "", str);
        }
    }

    return str;

END_JS
);
}
function __php__stripos($f_haystack,$f_needle,$f_offset){

JS( <<< END_JS
    var haystack = (f_haystack + '').toLowerCase();
    var needle = (f_needle + '').toLowerCase();
    var index = 0;

    if ((index = haystack.indexOf(needle, f_offset)) !== -1) {
        return index;
    }
    return false;

END_JS
);
}
function __php__stripslashes($str){

JS( <<< END_JS
    return (str + '').replace('/\0/g', '0').replace('/\(.)/g', '\$1');

END_JS
);
}
function __php__stristr($haystack,$needle,$bool){

JS( <<< END_JS
    var pos = 0;

    haystack += '';
    pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
    if (pos == -1) {
        return false;
    } else {
        if (bool) {
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }

END_JS
);
}
function __php__strlen($string){

JS( <<< END_JS
    return (string + '').length;

END_JS
);
}
function __php__strnatcmp($f_string1,$f_string2,$f_version){

JS( <<< END_JS
    if (f_version == undefined) {
        f_version = false;
    }

    var __strnatcmp_split = function(f_string) {
        var result = new Array();
        var buffer = '';
        var chr = '';
        var i = 0,
        f_stringl = 0;

        var text = true;

        f_stringl = f_string.length;
        for (i = 0; i < f_stringl; i++) {
            chr = f_string.substring(i, i + 1);
            if (chr.match(/[0-9]/)) {
                if (text) {
                    if (buffer.length > 0) {
                        result[result.length] = buffer;
                        buffer = '';
                    }

                    text = false;
                }
                buffer += chr;
            } else if ((text == false) && (chr == '.') && (i < (f_string.length - 1)) && (f_string.substring(i + 1, i + 2).match(/[0-9]/))) {
                result[result.length] = buffer;
                buffer = '';
            } else {
                if (text == false) {
                    if (buffer.length > 0) {
                        result[result.length] = parseInt(buffer);
                        buffer = '';
                    }
                    text = true;
                }
                buffer += chr;
            }
        }

        if (buffer.length > 0) {
            if (text) {
                result[result.length] = buffer;
            } else {
                result[result.length] = parseInt(buffer);
            }
        }

        return result;
    };

    var array1 = __strnatcmp_split(f_string1 + '');
    var array2 = __strnatcmp_split(f_string2 + '');

    var len = array1.length;
    var text = true;

    var result = -1;
    var r = 0;

    if (len > array2.length) {
        len = array2.length;
        result = 1;
    }

    for (i = 0; i < len; i++) {
        if (isNaN(array1[i])) {
            if (isNaN(array2[i])) {
                text = true;

                if ((r = strcmp(array1[i], array2[i])) != 0) {
                    return r;
                }
            } else if (text) {
                return 1;
            } else {
                return - 1;
            }
        } else if (isNaN(array2[i])) {
            if (text) {
                return - 1;
            } else {
                return 1;
            }
        } else {
            if (text || f_version) {
                if ((r = (array1[i] - array2[i])) != 0) {
                    return r;
                }
            } else {
                if ((r = strcmp(array1[i].toString(), array2[i].toString())) != 0) {
                    return r;
                }
            }

            text = false;
        }
    }

    return result;

END_JS
);
}
function __php__strncasecmp($str1,$str2,$len){

JS( <<< END_JS
    var diff;
    str1 = (str1 + '').toLowerCase().substr(0, len);
    str2 = (str2 + '').toLowerCase().substr(0, len);

    if (str1.length !== str2.length) {
        if (str1.length < str2.length) {
            len = str1.length;
            if (str2.substr(0, str1.length) == str1) {
                return str1.length - str2.length;
            }
        } else {
            len = str2.length;
            if (str1.substr(0, str2.length) == str2) {
                return str1.length - str2.length;
            }
        }
    } else {
        len = str1.length;
    }

    for (diff = 0, i = 0; i < len; i++) {
        diff = str1.charCodeAt(i) - str2.charCodeAt(i);
        if (diff !== 0) {
            return diff;
        }
    }

    return 0;

END_JS
);
}
function __php__strpbrk($haystack,$char_list){

JS( <<< END_JS
    haystack += '';
    char_list += '';
    var lon = haystack.length;
    var lon_search = char_list.length;
    var ret = false;
    var stack = '';

    if (lon >= lon_search) {
        if (lon == lon_search) {
            if (haystack == char_list) {
                ret = haystack;
            }
        } else {
            j = 0;
            i = 0;
            while (i < lon_search && j < lon && !ret) {
                if (char_list[i] == haystack[j]) {
                    i++;
                    if (i == lon_search) {
                        ret = true;
                    }
                }
                j++;
            }
            if (ret) {
                for (i = (j - lon_search); i < lon; i++) {
                    stack += haystack[i];
                }
            }
            if (stack != '') {
                ret = stack;
            }
        }
    }
    return ret;

END_JS
);
}
function __php__strpos($haystack,$needle,$offset){

JS( <<< END_JS
    var i = (haystack + '').indexOf(needle, offset);
    return i === -1 ? false: i;

END_JS
);
}
function __php__strrev($string){

JS( <<< END_JS
    var ret = '',
    i = 0;

    string += '';
    for (i = string.length - 1; i >= 0; i--) {
        ret += string.charAt(i);
    }

    return ret;

END_JS
);
}
function __php__strripos($haystack,$needle,$offset){

JS( <<< END_JS
    var i = (haystack + '').toLowerCase().lastIndexOf((needle + '').toLowerCase(), offset);
    return i >= 0 ? i: false;

END_JS
);
}
function __php__strrpos($haystack,$needle,$offset){

JS( <<< END_JS
    var i = (haystack + '').lastIndexOf(needle, offset);
    return i >= 0 ? i: false;

END_JS
);
}
function __php__strstr($haystack,$needle,$bool){

JS( <<< END_JS
    var pos = 0;

    haystack += '';
    pos = haystack.indexOf(needle);
    if (pos == -1) {
        return false;
    } else {
        if (bool) {
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }

END_JS
);
}
function __php__strtolower($str){

JS( <<< END_JS
    return (str + '').toLowerCase();

END_JS
);
}
function __php__strtoupper($str){

JS( <<< END_JS
    return (str + '').toUpperCase();

END_JS
);
}
function __php__substr($f_string,$f_start,$f_length){

JS( <<< END_JS
    f_string += '';

    if (f_start < 0) {
        f_start += f_string.length;
    }

    if (f_length == undefined) {
        f_length = f_string.length;
    } else if (f_length < 0) {
        f_length += f_string.length;
    } else {
        f_length += f_start;
    }

    if (f_length < f_start) {
        f_length = f_start;
    }

    return f_string.substring(f_start, f_length);

END_JS
);
}
function __php__substr_count($haystack,$needle,$offset,$length){

JS( <<< END_JS
    var pos = 0,
    cnt = 0;

    haystack += '';
    needle += '';
    if (isNaN(offset)) offset = 0;
    if (isNaN(length)) length = 0;
    offset--;

    while ((offset = haystack.indexOf(needle, offset + 1)) != -1) {
        if (length > 0 && (offset + needle.length) > length) {
            return false;
        } else {
            cnt++;
        }
    }

    return cnt;

END_JS
);
}
function __php__trim($str,$charlist){

JS( <<< END_JS
    var whitespace,
    l = 0,
    i = 0;
    str += '';

    if (!charlist) {
        whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    } else {
        charlist += '';
        whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\\$\^\:])/g, '\\$1');
    }

    l = str.length;
    for (i = 0; i < l; i++) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(i);
            break;
        }
    }

    l = str.length;
    for (i = l - 1; i >= 0; i--) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(0, i + 1);
            break;
        }
    }

    return whitespace.indexOf(str.charAt(0)) === -1 ? str: '';

END_JS
);
}
function __php__ucfirst($str){

JS( <<< END_JS
    str += '';
    var f = str.charAt(0).toUpperCase();
    return f + str.substr(1, str.length - 1);

END_JS
);
}
function __php__ucwords($str){

JS( <<< END_JS
    return (str + '').replace(/^(.)|\s(.)/g,
    function(\$1) {
        return \$1.toUpperCase();
    });

END_JS
);
}
function __php__wordwrap($str,$int_width,$str_break,$cut){

JS( <<< END_JS
    var m = ((arguments.length >= 2) ? arguments[1] : 75);
    var b = ((arguments.length >= 3) ? arguments[2] : "\n");
    var c = ((arguments.length >= 4) ? arguments[3] : false);

    var i,
    j,
    l,
    s,
    r;

    str += '';

    if (m < 1) {
        return str;
    }

    for (i = -1, l = (r = str.split("\n")).length; ++i < l; r[i] += s) {
        for (s = r[i], r[i] = ""; s.length > m; r[i] += s.slice(0, j) + ((s = s.slice(j)).length ? b: "")) {
            j = c == 2 || (j = s.slice(0, m + 1).match(/\S*(\s)?\$/))[1] ? m: j.input.length - j[0].length || c == 1 && m || j.input.length + (j = s.slice(m).match(/^\S*/)).input.length;
        }
    }

    return r.join("\n");

END_JS
);
}
function __php__base64_decode($data){

JS( <<< END_JS
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1,
    o2,
    o3,
    h1,
    h2,
    h3,
    h4,
    bits,
    i = ac = 0,
    dec = "",
    tmp_arr = [];

    data += '';

    do {
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));

        bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

        o1 = bits >> 16 & 0xff;
        o2 = bits >> 8 & 0xff;
        o3 = bits & 0xff;

        if (h3 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1);
        } else if (h4 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1, o2);
        } else {
            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
        }
    }
    while (i < data.length);

    dec = tmp_arr.join('');
    dec = utf8_decode(dec);

    return dec;

END_JS
);
}
function __php__base64_encode($data){

JS( <<< END_JS
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1,
    o2,
    o3,
    h1,
    h2,
    h3,
    h4,
    bits,
    i = ac = 0,
    enc = "",
    tmp_arr = [];
    data = utf8_encode(data);

    do {
        o1 = data.charCodeAt(i++);
        o2 = data.charCodeAt(i++);
        o3 = data.charCodeAt(i++);

        bits = o1 << 16 | o2 << 8 | o3;

        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;
        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;

        tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
    }
    while (i < data.length);

    enc = tmp_arr.join('');

    switch (data.length % 3) {
    case 1:
        enc = enc.slice(0, -2) + '==';
        break;
    case 2:
        enc = enc.slice(0, -1) + '=';
        break;
    }

    return enc;

END_JS
);
}
function __php__get_headers($url,$format){

JS( <<< END_JS
    var req = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
    if (!req) throw new Error('XMLHttpRequest not supported');
    var tmp,
    headers,
    pair,
    i;

    req.open('HEAD', url, false);
    req.send(null);

    if (req.readyState < 3) {
        return false;
    }

    tmp = req.getAllResponseHeaders();
    alert(tmp);
    tmp = tmp.split('\n');
    tmp = array_filter(tmp,
    function(value) {
        return value.substring(1) != '';
    });
    headers = [req.status + ' ' + req.statusText];

    for (i in tmp) {
        if (format) {
            pair = tmp[i].split(':');
            headers[pair.splice(0, 1)] = pair.join(':').substring(1);
        } else {
            headers[headers.length] = tmp[i];
        }
    }

    return headers;

END_JS
);
}
function __php__http_build_query($formdata,$numeric_prefix,$arg_separator){

JS( <<< END_JS
    var key,
    use_val,
    use_key,
    i = 0,
    j = 0,
    tmp_arr = [];

    if (!arg_separator) {
        arg_separator = '&';
    }

    for (key in formdata) {
        use_val = urlencode(formdata[key].toString());
        use_key = urlencode(key);

        if (numeric_prefix && !isNaN(key)) {
            use_key = numeric_prefix + j;
            j++;
        }
        tmp_arr[i++] = use_key + '=' + use_val;
    }

    return tmp_arr.join(arg_separator);

END_JS
);
}
function __php__urldecode($str){

JS( <<< END_JS
    var histogram = {},
    histogram_r = {},
    code = 0,
    str_tmp = [];
    var ret = str.toString();

    var replacer = function(search, replace, str) {
        var tmp_arr = [];
        tmp_arr = str.split(search);
        return tmp_arr.join(replace);
    };

    histogram['!'] = '%21';
    histogram['%20'] = '+';

    for (replace in histogram) {
        search = histogram[replace];
        ret = replacer(search, replace, ret)
    }

    ret = decodeURIComponent(ret);

    return ret;

END_JS
);
}
function __php__urlencode($str){

JS( <<< END_JS
    var histogram = {},
    histogram_r = {},
    code = 0,
    tmp_arr = [];
    var ret = str.toString();

    var replacer = function(search, replace, str) {
        var tmp_arr = [];
        tmp_arr = str.split(search);
        return tmp_arr.join(replace);
    };

    histogram['!'] = '%21';
    histogram['%20'] = '+';

    ret = encodeURIComponent(ret);

    for (search in histogram) {
        replace = histogram[search];
        ret = replacer(search, replace, ret)
    }

    return ret.replace(/(\%([a-z0-9]{2}))/g,
    function(full, m1, m2) {
        return "%" + m2.toUpperCase();
    });

    return ret;

END_JS
);
}
function __php__empty($mixed_var){

JS( <<< END_JS
    var key;

    if (mixed_var === ""
    || mixed_var === 0
    || mixed_var === "0"
    || mixed_var === null
    || mixed_var === false
    || mixed_var === undefined
    ) {
        return true;
    }
    if (typeof mixed_var == 'object') {
        for (key in mixed_var) {
            if (typeof mixed_var[key] !== 'function') {
                return false;
            }
        }
        return true;
    }
    return false;

END_JS
);
}
function __php__floatval($mixed_var){

JS( <<< END_JS
    return (parseFloat(mixed_var) || 0);

END_JS
);
}
function __php__gettype($mixed_var){

JS( <<< END_JS
    var type;

    switch (type = typeof mixed_var) {
    case 'undefined':
    case 'boolean':
    case 'string':
        return type;
        break;
    case 'number':
        return (is_float(mixed_var)) ? 'double': 'integer';
        break;
    case 'object':
    case 'array':
        if (is_array(mixed_var)) {
            return 'array';
        } else if (is_object(mixed_var)) {
            return 'object';
        }
        break;
    }

    return 'unknown type: ' + type;

END_JS
);
}
function __php__intval($mixed_var,$base){

JS( <<< END_JS
    var tmp;

    if (typeof(mixed_var) == 'string') {
        tmp = parseInt(mixed_var * 1);
        if (isNaN(tmp) || !isFinite(tmp)) {
            return 0;
        } else {
            return tmp.toString(base || 10);
        }
    } else if (typeof(mixed_var) == 'number' && isFinite(mixed_var)) {
        return Math.floor(mixed_var);
    } else {
        return 0;
    }

END_JS
);
}
function __php__is_array($mixed_var){

JS( <<< END_JS
    return (mixed_var instanceof Array || mixed_var instanceof Object);

END_JS
);
}
function __php__is_bool($mixed_var)
{

JS( <<< END_JS
    return (typeof mixed_var == 'boolean');

END_JS
);
}
function __php__is_double($mixed_var){

JS( <<< END_JS
    return is_float(mixed_var);

END_JS
);
}
function __php__is_float($mixed_var){

JS( <<< END_JS
    return parseFloat(mixed_var * 1) != parseInt(mixed_var * 1);

END_JS
);
}
function __php__is_int($mixed_var){

JS( <<< END_JS
    var y = parseInt(mixed_var * 1);

    if (isNaN(y)) {
        return false;
    }

    return mixed_var == y && mixed_var.toString() == y.toString();

END_JS
);
}
function __php__is_integer($mixed_var){

JS( <<< END_JS
    return is_int(mixed_var);

END_JS
);
}
function __php__is_long($mixed_var){

JS( <<< END_JS
    return is_float(mixed_var);

END_JS
);
}
function __php__is_null($mixed_var){

JS( <<< END_JS
    return (mixed_var === null);

END_JS
);
}
function __php__is_numeric($mixed_var){

JS( <<< END_JS
    return ! isNaN(mixed_var);

END_JS
);
}
function __php__is_object($mixed_var){

JS( <<< END_JS
    if (mixed_var instanceof Array) {
        return false;
    } else {
        return (mixed_var !== null) && (typeof(mixed_var) == 'object');
    }

END_JS
);
}
function __php__is_scalar($mixed_var){

JS( <<< END_JS
    return /boolean|number|string/.test(typeof mixed_var);

END_JS
);
}
function __php__is_string($mixed_var){

JS( <<< END_JS
    return (typeof(mixed_var) == 'string');

END_JS
);
}
function __php__isset(){

JS( <<< END_JS
    var a = arguments;
    var l = a.length;
    var i = 0;

    if (l == 0) {
        throw new Error('Empty isset');
    }

    while (i != l) {
        if (typeof(a[i]) == 'undefined' || a[i] === null) {
            return false;
        } else {
            i++;
        }
    }
    return true;

END_JS
);
}
function __php__print_r($array,$return_val){

JS( <<< END_JS
    var output = "",
    pad_char = " ",
    pad_val = 4;

    var formatArray = function(obj, cur_depth, pad_val, pad_char) {
        if (cur_depth > 0) {
            cur_depth++;
        }

        var base_pad = repeat_char(pad_val * cur_depth, pad_char);
        var thick_pad = repeat_char(pad_val * (cur_depth + 1), pad_char);
        var str = "";

        if (obj instanceof Array || obj instanceof Object) {
            str += "Array\n" + base_pad + "(\n";
            for (var key in obj) {
                if (obj[key] instanceof Array) {
                    str += thick_pad + "[" + key + "] => " + formatArray(obj[key], cur_depth + 1, pad_val, pad_char);
                } else {
                    str += thick_pad + "[" + key + "] => " + obj[key] + "\n";
                }
            }
            str += base_pad + ")\n";
        } else if (obj == null || obj == undefined) {
            str = '';
        } else {
            str = obj.toString();
        }

        return str;
    };

    var repeat_char = function(len, pad_char) {
        var str = "";
        for (var i = 0; i < len; i++) {
            str += pad_char;
        };
        return str;
    };
    output = formatArray(array, 0, pad_val, pad_char);

    if (return_val !== true) {
        document.write("<pre>" + output + "</pre>");
        return true;
    } else {
        return output;
    }

END_JS
);
}
function __php__serialize($mixed_value){

JS( <<< END_JS
    var _getType = function(inp) {
        var type = typeof inp,
        match;
        var key;
        if (type == 'object' && !inp) {
            return 'null';
        }
        if (type == "object") {
            if (!inp.constructor) {
                return 'object';
            }
            var cons = inp.constructor.toString();
            if (match = cons.match(/(\w+)\(/)) {
                cons = match[1].toLowerCase();
            }
            var types = ["boolean", "number", "string", "array"];
            for (key in types) {
                if (cons == types[key]) {
                    type = types[key];
                    break;
                }
            }
        }
        return type;
    };
    var type = _getType(mixed_value);
    var val,
    ktype = '';

    switch (type) {
    case "function":
        val = "";
        break;
    case "undefined":
        val = "N";
        break;
    case "boolean":
        val = "b:" + (mixed_value ? "1": "0");
        break;
    case "number":
        val = (Math.round(mixed_value) == mixed_value ? "i": "d") + ":" + mixed_value;
        break;
    case "string":
        val = "s:" + mixed_value.length + ":\"" + mixed_value + "\"";
        break;
    case "array":
    case "object":
        val = "a";
        var count = 0;
        var vals = "";
        var okey;
        var key;
        for (key in mixed_value) {
            ktype = _getType(mixed_value[key]);
            if (ktype == "function" && ktype == "object") {
                continue;
            }

            okey = (key.match(/^[0-9]+\$/) ? parseInt(key) : key);
            vals += serialize(okey) +
            serialize(mixed_value[key]);
            count++;
        }
        val += ":" + count + ":{" + vals + "}";
        break;
    }
    if (type != "object" && type != "array") val += ";";
    return val;

END_JS
);
}
function __php__unserialize($data){

JS( <<< END_JS
    var error = function(type, msg, filename, line) {
        throw new window[type](msg, filename, line);
    };
    var read_until = function(data, offset, stopchr) {
        var buf = [];
        var chr = data.slice(offset, offset + 1);
        var i = 2;
        while (chr != stopchr) {
            if ((i + offset) > data.length) {
                error('Error', 'Invalid');
            }
            buf.push(chr);
            chr = data.slice(offset + (i - 1), offset + i);
            i += 1;
        }
        return [buf.length, buf.join('')];
    };
    var read_chrs = function(data, offset, length) {
        buf = [];
        for (var i = 0; i < length; i++) {
            var chr = data.slice(offset + (i - 1), offset + i);
            buf.push(chr);
        }
        return [buf.length, buf.join('')];
    };
    var _unserialize = function(data, offset) {
        if (!offset) offset = 0;
        var buf = [];
        var dtype = (data.slice(offset, offset + 1)).toLowerCase();

        var dataoffset = offset + 2;
        var typeconvert = new Function('x', 'return x');
        var chrs = 0;
        var datalength = 0;

        switch (dtype) {
        case "i":
            typeconvert = new Function('x', 'return parseInt(x)');
            var readData = read_until(data, dataoffset, ';');
            var chrs = readData[0];
            var readdata = readData[1];
            dataoffset += chrs + 1;
            break;
        case "b":
            typeconvert = new Function('x', 'return (parseInt(x) == 1)');
            var readData = read_until(data, dataoffset, ';');
            var chrs = readData[0];
            var readdata = readData[1];
            dataoffset += chrs + 1;
            break;
        case "d":
            typeconvert = new Function('x', 'return parseFloat(x)');
            var readData = read_until(data, dataoffset, ';');
            var chrs = readData[0];
            var readdata = readData[1];
            dataoffset += chrs + 1;
            break;
        case "n":
            readdata = null;
            break;
        case "s":
            var ccount = read_until(data, dataoffset, ':');
            var chrs = ccount[0];
            var stringlength = ccount[1];
            dataoffset += chrs + 2;

            var readData = read_chrs(data, dataoffset + 1, parseInt(stringlength));
            var chrs = readData[0];
            var readdata = readData[1];
            dataoffset += chrs + 2;
            if (chrs != parseInt(stringlength) && chrs != readdata.length) {
                error('SyntaxError', 'String length mismatch');
            }
            break;
        case "a":
            var readdata = {};

            var keyandchrs = read_until(data, dataoffset, ':');
            var chrs = keyandchrs[0];
            var keys = keyandchrs[1];
            dataoffset += chrs + 2;

            for (var i = 0; i < parseInt(keys); i++) {
                var kprops = _unserialize(data, dataoffset);
                var kchrs = kprops[1];
                var key = kprops[2];
                dataoffset += kchrs;

                var vprops = _unserialize(data, dataoffset);
                var vchrs = vprops[1];
                var value = vprops[2];
                dataoffset += vchrs;

                readdata[key] = value;
            }

            dataoffset += 1;
            break;
        default:
            error('SyntaxError', 'Unknown / Unhandled data type(s): ' + dtype);
            break;
        }
        return [dtype, dataoffset - offset, typeconvert(readdata)];
    };
    return _unserialize(data, 0)[2];

END_JS
);
}
function __php__var_export($mixed_expression,$bool_return){

JS( <<< END_JS
    var retstr = "";
    var iret = "";
    var cnt = 0;
    var x = [];

    var __getType = function(inp) {
        var type = typeof inp,
        match;
        if (type == 'object' && !inp) {
            return 'null';
        }
        if (type == "object") {
            if (!inp.constructor) {
                return 'object';
            }
            var cons = inp.constructor.toString();
            if (match = cons.match(/(\w+)\(/)) {
                cons = match[1].toLowerCase();
            }
            var types = ["boolean", "number", "string", "array"];
            for (key in types) {
                if (cons == types[key]) {
                    type = types[key];
                    break;
                }
            }
        }
        return type;
    };
    var type = __getType(mixed_expression);

    if (type === null) {
        retstr = "NULL";
    } else if (type == 'array' || type == 'object') {
        for (i in mixed_expression) {
            x[cnt++] = var_export(i, true) + " => " + var_export(mixed_expression[i], true);
        }
        iret = x.join(',\n  ');
        retstr = "array (\n  " + iret + "\n)";
    } else {
        retstr = (!isNaN(mixed_expression)) ? mixed_expression: "'" + mixed_expression.replace('/(["\'\])/g', "\\\$1").replace('/\0/g', "\\0") + "'";
    }

    if (bool_return != true) {
        echo(retstr);
        return null;
    } else {
        return retstr;
    }

END_JS
);
}
function __php__utf8_decode($str_data){

JS( <<< END_JS
    var tmp_arr = [],
    i = ac = c1 = c2 = c3 = 0;

    str_data += '';

    while (i < str_data.length) {
        c1 = str_data.charCodeAt(i);
        if (c1 < 128) {
            tmp_arr[ac++] = String.fromCharCode(c1);
            i++;
        } else if ((c1 > 191) && (c1 < 224)) {
            c2 = str_data.charCodeAt(i + 1);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
            i += 2;
        } else {
            c2 = str_data.charCodeAt(i + 1);
            c3 = str_data.charCodeAt(i + 2);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }
    }

    return tmp_arr.join('');

END_JS
);
}
function __php__utf8_encode($string){

JS( <<< END_JS
    string = (string + '').replace(/\r\n/g, "\n").replace(/\r/g, "\n");

    var utftext = "";
    var start,
    end;
    var stringl = 0;

    start = end = 0;
    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;

        if (c1 < 128) {
            end++;
        } else if ((c1 > 127) && (c1 < 2048)) {
            enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
        } else {
            enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
        }
        if (enc != null) {
            if (end > start) {
                utftext += string.substring(start, end);
            }
            utftext += enc;
            start = end = n + 1;
        }
    }

    if (end > start) {
        utftext += string.substring(start, string.length);
    }

    return utftext;

END_JS
);
}