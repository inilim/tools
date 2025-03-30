<?php

declare(strict_types=1);

use Inilim\Tool\Other;
use Inilim\Tool\Test\ForTest\ClassicClass;

require_once __DIR__ . '/bootstrap.php';


// de(get_defined_constants(true)['Core']);
// de(\array_keys(get_defined_vars()));
// __include('Str::excerpt');

Other::tryCallWithErrHandler(static function () {
    echo 'start';
    try {
        callNotFoundFn();
    } catch (\Throwable $e) {
    }
    echo 'end';
}, static function ($lvl, $msg, $file, $line, $context) {
    de($context);
});




de();

$res = \Inilim\Tool\Method\Str\excerpt('hello', 'y', ['radius' => 0]);

dde($res);



de();
__include('Other::getClosureScopeClass');

$a = new ClassicClass;

$cls = $a->getClosureWithContext();

\Inilim\Tool\Method\Other\getClosureScopeClass($cls);





de();

static function (array $array, $key) {
    $value = \array_search(
        \key([$key => null]),
        \array_keys($array),
        true
    );
    return $value === false ? null : $value;
};

dUsage();






de();
final class Test
{
    protected static $instance;

    protected function __construct() {}

    static function __callStatic($name, $arguments)
    {
        self::$instance ??= new self;
        return self::$instance->__get($name);
    }

    function __get($name)
    {
        return static function () {
            echo 123;
        };
    }
}

Test::name()();
