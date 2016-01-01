#!/usr/bin/env php
<?php

/**
 * Show errors at least initially
 *
 * `E_ALL` => for hard dev
 * `E_ALL & ~E_STRICT` => for hard dev in PHP5.4 avoiding strict warnings
 * `E_ALL & ~E_NOTICE & ~E_STRICT` => classic setting
 */
@ini_set('display_errors', '1'); @error_reporting(E_ALL);
//@ini_set('display_errors','1'); @error_reporting(E_ALL & ~E_STRICT);
//@ini_set('display_errors','1'); @error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

/**
 * Set a default timezone to avoid PHP5 warnings
 */
$dtmz = @date_default_timezone_get();
date_default_timezone_set($dtmz?:'Europe/Paris');
    
// -----------------------------------
// NAMESPACE
// -----------------------------------

// get the Composer autoloader
if (file_exists($a = __DIR__.'/../../../autoload.php')) {
    require_once $a;
} elseif (file_exists($b = __DIR__.'/../vendor/autoload.php')) {
    require_once $b;

// else try to register `Reflectors` namespace
} elseif (file_exists($c = __DIR__.'/../src/SplClassLoader.php')) {
    require_once $c;
    $classLoader = new SplClassLoader('Reflectors', __DIR__.'/../src');
    $classLoader->register();

// else error, classes can't be found
} else {
    die('You need to run Composer on your project to use this interface!');
}


function callBacktrace($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value'))
{
    try {
        debug_print_backtrace();
        echo "##############".PHP_EOL;

        $obj = new \Reflectors\ReflectionBacktrace();
/*
        $raw_traces = $obj->getRawTraces();
        $traces = $obj->getTraces();

        foreach ($traces as $i=>$trace) {

            echo "##############".PHP_EOL;
            echo "TRACE ".$i.PHP_EOL;
            echo "##############".PHP_EOL;
            $raw_trace = $raw_traces[$i];
            unset($raw_trace['object']);
            var_export($raw_trace);
            echo "##############".PHP_EOL;
            var_export($trace);
            echo "##############".PHP_EOL;
            $trace->getCalled();
            var_export($trace);
            echo "##############".PHP_EOL;
            $trace->getFunction();
            var_export($trace);
            echo "##############".PHP_EOL;
            $trace->getClass();
            var_export($trace);
            echo "##############".PHP_EOL;
            $trace->getArguments();
            var_export($trace);



        }
*/
//        exit('yo');
    } catch (\Exception $e) {
        echo 'YO'.$e->__toString();
        return;
    }
    return $obj;
}

header('Content-Type: text/plain');
ini_set('html_errors', 0);

$reflt_obj = callBacktrace('arg 1 value', 12);
echo $reflt_obj;

exit(PHP_EOL.'-- out --'.PHP_EOL);
