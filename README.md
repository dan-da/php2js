# php2js

php2js is a tool that can automatically translate PHP code into Javascript code.

I originally wrote this back in 2008 and am just now (2015) getting around to
releasing it on github.

I wrote this as part of a larger project, phpwt, which is a PHP port of pyjamas,
which is itself a port of GWT to python.

The code has not been maintained for years and the language translation will
never be 100% due to differing language features and libraries, but I am
releasing it anyway in case someone finds it useful.

## An example of code translation:

### Original PHP Code
```php
function test1() {

    $arr = array('colors' => array("red" => 'Red', 'green' => "Green"),
                 'candies' => array('twix','snickers', 'jolly ranchers'),
                 'holiday' => 'christmas'
                 );

    $arr['planet'] = 'Earth';

    $okay = $arr['colors']['red'] == 'Red' &&
            $arr['candies'][1] == 'snickers' &&
            $arr['holiday'] == 'christmas';

    echo "Test that assoc array init and deref works<br>\n";
    echo 'Result: ' . (($okay === true) ? 'pass' : 'fail') . "\n\n";

}

test1();
```

### Translated Javascript code

```js
test1 = function() {
var arr = ___array([ "__kv", "colors",___array([ "__kv", "red","Red"],[ "__kv", "green","Green"])],[ "__kv", "candies",___array("twix","snickers","jolly ranchers")],[ "__kv", "holiday","christmas"]);
arr["planet"] = "Earth";
var okay = arr["colors"]["red"]=="Red"&&arr["candies"][1]=="snickers"&&arr["holiday"]=="christmas";
___echo("Test that assoc array init and deref works<br>\n");
___echo("Result: "+((okay===true)?"pass":"fail")+"\n\n");

}

test1();
```

## Supports standard PHP functions!

A cool thing is that most of the built-in PHP functions work as expected after
translation to javascript.

For example, sprintf(), extract(), implode(), date(), array_keys(), array_merge()
and on and on.  These work because the translator automatically includes the
php.js library, from the fine folks at phpjs.org.

# Why use it?

This tool can be useful any time you have code already written in PHP that
you would like to translate into JS.

Typically this would be when moving code from server-side to the browser.

One possible use case could be to have a set of validation routines that are
written in PHP for the server, but a build system automatically translates them
to javascript so that the same validation logic can be made client side without
requiring server interaction.


# Requirements


* PHP 5.5+
* [PHC PHP Compiler](http://www.phpcompiler.org/)
* [SpiderMonkey Javascript engine](https://developer.mozilla.org/en-US/docs/Mozilla/Projects/SpiderMonkey) or nodejs.

note: spidermonkey (or nodejs) is only needed for running the test cases from the
command line.

# Installing

1) Clone the php2js repo.

2) Install PHC if not already present.

3) Install Spidermonkey if not already present.  On Ubuntu, just

```
sudo apt-get install libmozjs-24-bin
```
 
4) Generate the test cases.

```
cd phpwt_tests
./gen_all_tests
```

5) Run the test cases

```
./test_runner
```


Note: as of this writing, 88 test cases pass, and 11 are failing.


# Usage

```
php2js   -- a tool to translate PHP code into JS code.

Usage:
    php2js [options] <php-file> [include-paths]
    
Options:
    --help               Display usage info.
    --exclude-phpjs      Do not include phpjs javascript library in output.
```

Translated javascript will be printed to STDOUT and may be redirected to a file.

By default, the generated javascript will contain the phpjs function library and
your translated code will be at the end.

In a future version, hopefully we can remove any unused library functions to
keep the generated output smaller.



