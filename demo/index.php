<?php
    
/**
 * Show errors at least initially
 *
 * `E_ALL` => for hard dev
 * `E_ALL & ~E_STRICT` => for hard dev in PHP5.4 avoiding strict warnings
 * `E_ALL & ~E_NOTICE & ~E_STRICT` => classic setting
 */
@ini_set('display_errors','1'); @error_reporting(E_ALL);
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

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Reflectors</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul id="navigation_menu" class="nav navbar-nav" role="navigation">
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
function testFunction($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value')) {}

function throwException($str) {
    throw new \Exception($str);
}

class MySmallObject {
    public $name;
    protected $type;
    static $_defaults = array();
    public function __construct($name, $type = 'anonymous', $opt = array('on','two','azerty'=>'three')) {
        $this->name = $name;
        $this->type = $type;
    }
    function setSelf(MySmallObject $obj){}
    function testFunctionPublic($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value')) {}
    protected function testFunctionProtected($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value')) {}
    private function testFunctionPrivate($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value')) {}
    static function testFunctionStatic($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value')) {}
}


//header('Content-Type: text/plain');
ini_set('html_errors', 0);
$small_obj = new MySmallObject('david');
?>

<h2>Internal objects <em>(as reminders ...)</em></h2>

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

<code>$reflt_obj = new \Reflectors\ReflectionParameterValue(array('MySmallObject', 'testFunctionPublic'), 'my_arg2', 3);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionParameterValue(array('MySmallObject', 'testFunctionPublic'), 'my_arg2', 3);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionVariable('type');</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable('type');
echo '<pre>'.$reflt_obj.'</pre>';
?>

<h2>New reflection objects introduced by the package</h2>
<code>$reflt_obj = new \Reflectors\ReflectionVariable(10);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable(10);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionVariable(10.76);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable(10.76);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionVariable(false);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable(false);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionVariable(true);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable(true);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionVariable(0);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable(0);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionVariable(1);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable(1);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionVariable(array('one', 'two', 'mklj'=>'three'));</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable(array('one', 'two', 'mklj'=>'three'));
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionVariable($small_obj);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionVariable($small_obj);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$fp = @fopen("tmp/foo", "w"); $reflt_obj = new \Reflectors\ReflectionVariable($fp);</code>
<?php
$fp = @fopen("tmp/foo", "w");
$reflt_obj = new \Reflectors\ReflectionVariable($fp);
echo '<pre>'.$reflt_obj.'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionSource(__FILE__, __LINE__);</code>
<?php
$reflt_obj = new \Reflectors\ReflectionSource(__FILE__, __LINE__);
echo '<pre>'.htmlspecialchars($reflt_obj).'</pre>';
?>

<code>$reflt_obj = new \Reflectors\ReflectionBacktrace();</code>
<?php
function callBacktrace($my_arg1, $my_arg2 = 4, array $my_arg3 = array('one', 'two', 'three'=>'value')) {
    return new \Reflectors\ReflectionBacktrace();
}

$reflt_obj = callBacktrace('arg 1 value', 12);
echo '<pre>'.$reflt_obj.'</pre>';
?>

        </div>
    </div>

    <footer id="footer">
        <div class="container">
            <div class="text-muted pull-left">
                This page is <a href="" title="Check now online" id="html_validation">HTML5</a> & <a href="" title="Check now online" id="css_validation">CSS3</a> valid.
            </div>
            <div class="text-muted pull-right">
                <a href="http://github.com/atelierspierrot/reflectors">atelierspierrot/reflectors</a> package by <a href="https://github.com/piwi">@piwi</a> under <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache 2.0</a> license.
                <p class="text-muted small" id="user_agent"></p>
            </div>
        </div>
    </footer>

    <div id="message_box" class="msg_box"></div>
    <a id="bottom"></a>

<!-- jQuery lib -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<!-- scripts for demo -->
<script src="assets/scripts.js"></script>

<script>
$(function() {
    getToHash();
    addCSSValidatorLink('assets/styles.css');
    addHTMLValidatorLink();
    $("#user_agent").html( navigator.userAgent );
    $('pre').each(function(i,o) {
        var dl = $(this).attr('data-language');
        if (dl) {
            $(this).addClass('code')
                .highlight({indent:'tabs', code_lang: 'data-language'});
        }
    });
    initHandler('classinfo', true);
    initHandler('plaintext', true);
});
</script>
</body>
</html>
