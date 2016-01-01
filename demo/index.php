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

/*//
//    highlight_file(__FILE__);
    highlight_string('<?php $reflt_obj = new \Reflectors\ReflectionSource(__FILE__, 147, array(\'function\'=>\'testFunctionProtected\'))');

    exit('yo');
//*/
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

// -----------------------------------
// Page Content
// -----------------------------------
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test & documentation of PHP "Reflectors" package</title>
<!-- Bootstrap -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://github.com/atelierspierrot/reflectors" title="See source on GitHub">
                    <span class="fa fa-github"></span>
                    Reflectors
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul id="navigation_menu" class="nav navbar-nav" role="navigation">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Page menu <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#value-types">Value types</a></li>
                            <li><a href="#reflection-values">RefectionValue</a></li>
                            <li><a href="#internals">Internals</a></li>
                            <li><a href="#reflectors">Reflectors</a></li>
                        </ul>
                    </li>
                    <li><a href="http://github.com/atelierspierrot/reflectors">GitHub</a></li>
                    <li><a href="http://docs.ateliers-pierrot.fr/reflectors/">API</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right" role="navigation">
                    <li><a href="#bottom" title="Go to the bottom of the page">&darr;</a></li>
                    <li><a href="#top" title="Back to the top of the page">&uarr;</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">

        <a id="top"></a>

        <header role="banner">
            <h1>The PHP "<em>Reflectors</em>" package <br><small>Some PHP Reflectors objects to complete the <a href="http://php.net/manual/book.reflection.php">internal Reflection</a>.</small></h1>
            <div class="hat">
                <p>These pages show and demonstrate the use and functionality of the <a href="http://github.com/atelierspierrot/reflectors">atelierspierrot/reflectors</a> PHP package you just downloaded.</p>
                <p>All objects defined in this package implement the <a href="http://php.net/manual/class.reflector.php">\Reflector interface</a> and generate a simple output to keep compliant with existing internal reflection objects.</p>
            </div>
        </header>
        

        <div id="content" role="main">



<?php
function testFunction($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value'))
{
}

function throwException($str)
{
    throw new \Exception($str);
}

class MySmallObject
{
    public $name;
    protected $type;
    public static $_defaults = array();
    public function __construct($name, $type = 'anonymous', $opt = array('on', 'two', 'azerty'=>'three'))
    {
        $this->name = $name;
        $this->type = $type;
    }
    public function setSelf(MySmallObject $obj)
    {
        return 'this is the return of '.__METHOD__;
    }
    public function testFunctionPublic($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value'))
    {
        return 'this is the return of '.__METHOD__;
    }
    protected function testFunctionProtected($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value'))
    {
        return 'this is the return of '.__METHOD__;
    }
    private function testFunctionPrivate($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value'))
    {
        return 'this is the return of '.__METHOD__;
    }
    public static function testFunctionStatic($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value'))
    {
        return 'this is the return of '.__METHOD__;
    }
    public function throwExceptionCaller($str, $arg2 = 'my string')
    {
        $this->name = $str;
        return $this->throwException($arg2, $this);
    }
    public function throwException($str, MySmallObject $object = null)
    {
        throw new \Exception($str);
    }
    public function triggerErrorCaller($str, $arg2 = 'my string')
    {
        $this->name = $str;
        return $this->triggerError($arg2, $this);
    }
    public function triggerError($str, MySmallObject $object = null)
    {
        user_error($str, E_USER_ERROR);
    }
    public function backtraceCaller($str, $arg2 = 'my string')
    {
        $this->name = $str;
        return $this->backtrace($arg2, $this);
    }
    public function backtrace($str, MySmallObject $object = null)
    {
        return new \Reflectors\ReflectionBacktrace();
    }
}


//header('Content-Type: text/plain');
ini_set('html_errors', 0);
$small_obj = new MySmallObject('david');
?>

<h2 id="value-types">Value types extended</h2>

<p>The <var>\Reflector\ValueType</var> static class defines an extending list of PHP values types and a set of validators and getters for each of them.</p>

<pre>
<?php
$rflt_type = new \ReflectionClass('Reflectors\ValueType');
foreach ($rflt_type->getConstants() as $cst=>$val) {
    if (substr($cst, 0, 5)=='TYPE_') {
        echo $cst.' :: '.$val.PHP_EOL;
    }
}
?>
</pre>

<h2 id="reflection-values">The <var>ReflectionValue</var> family</h2>

<p>The package embeds a special class to reflect each of the values of the <var>ValueType</var> base class as a <code>ReflectionValue[value type]</code>.
They all implement the <var>ReflectionVariableInterface</var> interface.</p>

<h2 id="internals">Internal objects <em>(as reminders ...)</em></h2>

<code>$reflt_obj = new \ReflectionClass('MySmallObject');</code>
<?php
$reflt_obj = new \ReflectionClass('MySmallObject');
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \ReflectionFunction('testFunction');</code>
<?php
$reflt_obj = new \ReflectionFunction('testFunction');
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \ReflectionMethod('MySmallObject', 'testFunctionProtected');</code>
<?php
$reflt_obj = new \ReflectionMethod('MySmallObject', 'testFunctionProtected');
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \ReflectionMethod('MySmallObject', 'testFunctionPrivate');</code>
<?php
$reflt_obj = new \ReflectionMethod('MySmallObject', 'testFunctionPrivate');
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \ReflectionObject($small_obj);</code>
<?php
$reflt_obj = new \ReflectionObject($small_obj);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \ReflectionParameter(array('MySmallObject', 'setSelf'), 'obj');</code>
<?php
$reflt_obj = new \ReflectionParameter(array('MySmallObject', 'setSelf'), 'obj');
echo '<pre>'.$reflt_obj.'</pre>';

// test the internal error while trying to get/set property 'name'
/*//
echo $reflt_obj->name, PHP_EOL;
echo $reflt_obj->azerty, PHP_EOL;
//$reflt_obj->name = 'test';
$reflt_obj->azerty = 'test';
echo $reflt_obj->azerty, PHP_EOL;
//*/
?>

<code>$reflt_obj = new \ReflectionProperty('MySmallObject', '_defaults');</code>
<?php
$reflt_obj = new \ReflectionProperty('MySmallObject', '_defaults');
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \ReflectionParameter(array('MySmallObject', 'testFunctionPublic'), 'my_arg2');</code>
<?php
$reflt_obj = new \ReflectionParameter(array('MySmallObject', 'testFunctionPublic'), 'my_arg2');
echo '<pre>'.$reflt_obj.'</pre>';
?>



<h2 id="reflectors">New reflection objects introduced by the package</h2>

<code>$reflt_obj = new \Reflectors\ReflectionParameterValue(array('MySmallObject', 'testFunctionPublic'), 'my_arg2', 3);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionParameterValue(array('MySmallObject', 'testFunctionPublic'), 'my_arg2', 3);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

            <h3>The <var>ReflectionValue</var> object on a <em>string</em></h3>

<code>$reflt_obj = new \Reflectors\ReflectionValue('type');</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue('type');
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();

/*//
// test of direct access
echo $reflt_obj->value.PHP_EOL;
echo $reflt_obj->type.PHP_EOL;
echo $reflt_obj->azerty.PHP_EOL;

//$reflt_obj->value = 'user value';
unset($reflt_obj->type);
//*/
?>
</pre>

            <h3>The <var>ReflectionValue</var> object on an <em>integer</em></h3>

<code>$reflt_obj = new \Reflectors\ReflectionValue(10);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(10);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

            <h3>The <var>ReflectionValue</var> object on a <em>float</em></h3>
<code>$reflt_obj = new \Reflectors\ReflectionValue(10.76);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(10.76);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

            <h3>The <var>ReflectionValue</var> object on <em>booleans</em></h3>
<code>$reflt_obj = new \Reflectors\ReflectionValue(false);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(false);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

<code>$reflt_obj = new \Reflectors\ReflectionValue(true);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(true);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

<code>$reflt_obj = new \Reflectors\ReflectionValue(0);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(0);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

<code>$reflt_obj = new \Reflectors\ReflectionValue(1);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(1);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

<code>$reflt_obj = new \Reflectors\ReflectionValue(1, \Reflectors\ValueType::BINARY_AS_BOOLEAN);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(1, \Reflectors\ValueType::BINARY_AS_BOOLEAN);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

<code>$reflt_obj = new \Reflectors\ReflectionValue(1,<br />
&nbsp;\Reflectors\ValueType::BINARY_AS_BOOLEAN,<br />
&nbsp;array(<br />
    &nbsp;&nbsp;0 => \Reflectors\ValueType::TYPE_NULL,<br />
    &nbsp;&nbsp;1 => \Reflectors\ValueType::TYPE_INTEGER,<br />
    &nbsp;&nbsp;2 => \Reflectors\ValueType::TYPE_BOOLEAN,<br />
    &nbsp;&nbsp;3 => \Reflectors\ValueType::TYPE_FLOAT,<br />
    &nbsp;&nbsp;4 => \Reflectors\ValueType::TYPE_CALLBACK,<br />
    &nbsp;&nbsp;5 => \Reflectors\ValueType::TYPE_STRING,<br />
    &nbsp;&nbsp;6 => \Reflectors\ValueType::TYPE_ARRAY,<br />
    &nbsp;&nbsp;7 => \Reflectors\ValueType::TYPE_OBJECT,<br />
    &nbsp;&nbsp;8 => \Reflectors\ValueType::TYPE_RESOURCE,<br />
&nbsp;)<br />
);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(1,
    \Reflectors\ValueType::BINARY_AS_BOOLEAN,
    array(
        0 => \Reflectors\ValueType::TYPE_NULL,
        1 => \Reflectors\ValueType::TYPE_INTEGER,
        2 => \Reflectors\ValueType::TYPE_BOOLEAN,
        3 => \Reflectors\ValueType::TYPE_FLOAT,
        4 => \Reflectors\ValueType::TYPE_CALLBACK,
        5 => \Reflectors\ValueType::TYPE_STRING,
        6 => \Reflectors\ValueType::TYPE_ARRAY,
        7 => \Reflectors\ValueType::TYPE_OBJECT,
        8 => \Reflectors\ValueType::TYPE_RESOURCE,
    )
);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

            <h3>The <var>ReflectionValue</var> object on an <em>array</em></h3>
<code>$reflt_obj = new \Reflectors\ReflectionValue(array('one', 'two', 'mklj'=>'three'));</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue(array('one', 'two', 'mklj'=>'three'));
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

            <h3>The <var>ReflectionValue</var> object on an <em>instantiated object</em></h3>
<code>$reflt_obj = new \Reflectors\ReflectionValue($small_obj);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionValue($small_obj);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

<code>$reflt = $reflt_obj->getReflector();</code>
<pre>
<?php
$reflt = $reflt_obj->getReflector();
echo get_class($reflt);
?>
</pre>

<code>$reflt->getMethods();</code>
<pre>
<?php
echo var_export($reflt->getMethods(), 1);
?>
</pre>

            <h3>The <var>ReflectionValue</var> object on a <em>resource</em></h3>
<code>$fp = fopen(__FILE__, 'r'); $reflt_obj = new \Reflectors\ReflectionValue($fp);</code>
<pre>
<?php
$fp = fopen(__FILE__, 'r');
$reflt_obj = new \Reflectors\ReflectionValue($fp);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

            <h3>The <var>ReflectionValue</var> object on <em>callbacks</em></h3>
<code>$c = 12; $fct = function ($a, $b=1) use ($c) { return ($a + $b + $c); }; $reflt_obj = new \Reflectors\ReflectionValue($fct);</code>
<pre>
<?php
$c = 12; $fct = function ($a, $b=1) use ($c) { return ($a + $b + $c); };
$reflt_obj = new \Reflectors\ReflectionValue($fct);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

<code>$reflt_obj->getReflector()->invoke(4);</code>
<pre>
<?php
$result = $reflt_obj->getReflector()->invoke(4);
echo $result;
?>
</pre>

<code>$cb = array('MySmallObject', 'testFunctionStatic'); $reflt_obj = new \Reflectors\ReflectionValue($cb);</code>
<pre>
<?php
$cb = array('MySmallObject', 'testFunctionStatic');
$reflt_obj = new \Reflectors\ReflectionValue($cb);
echo $reflt_obj, PHP_EOL, $reflt_obj->getValueType();
?>
</pre>

<code>$reflt_obj = new \Reflectors\ReflectionSource(__FILE__, __LINE__);</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionSource(__FILE__, __LINE__);
echo htmlspecialchars($reflt_obj);
?>
</pre>

<code>$reflt_obj = new \Reflectors\ReflectionSource(__FILE__, 147, array('function'=>'testFunctionProtected'));</code>
<pre>
<?php
$reflt_obj = new \Reflectors\ReflectionSource(__FILE__, 147, array('function'=>'testFunctionProtected'));
echo htmlspecialchars($reflt_obj);
?>
</pre>

<code>$reflt_obj->render();</code>
<pre>
<?php $reflt_obj->render(); ?>
</pre>

<code>$reflt_obj->renderHighlight();</code>
<?php $reflt_obj->renderHighlight(); ?>

<code>$reflt_obj->renderHighlight(false, true);</code>
<?php $reflt_obj->renderHighlight(false, true); ?>

<code>$reflt_obj = new \Reflectors\ReflectionBacktrace();</code>
<pre>
<?php
function callBacktrace($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value'))
{
    $obj = new MySmallObject('david');
    return $obj->backtraceCaller($my_arg2);
}
$reflt_obj = callBacktrace('arg 1 value', 12);
echo $reflt_obj;
?>
</pre>

        </div>
    </div>

    <footer id="footer">
        <div class="container">
            <div class="text-muted pull-left">
                <p class="text-muted small" id="user_agent"></p>
            </div>
            <div class="text-muted pull-right">
                <a href="http://github.com/atelierspierrot/reflectors">atelierspierrot/reflectors</a> package by <a href="https://github.com/piwi">@piwi</a> under <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache 2.0</a> license.
            </div>
        </div>
    </footer>

    <a id="bottom"></a>

<!-- jQuery lib -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<!-- scripts for demo -->
<script src="assets/scripts.js"></script>

<script>
$(function() {
    $("#user_agent").html( navigator.userAgent );
    $('pre[data-language]').addClass('code').highlight({source:0, indent:'tabs', code_lang: 'data-language'});
});
</script>
</body>
</html>
