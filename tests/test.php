<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Inilim\Tool\Arr;
use Inilim\Tool\Str;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\File;
use Inilim\Tool\Json;
use Inilim\Tool\Refl;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use DragonCode\Benchmark\Benchmark;
use Inilim\Tool\Test\ForTest\ClassicClass;

Dump::init();

/**
 * @param mixed $value
 * @return bool
 */
function setValueProp(object $object, string $name, $value, bool $throw = false)
{
    $name = \strtr($name, ['$' => '']);
    try {
        $prop = new \ReflectionProperty($object, $name);
    } catch (\ReflectionException $e) {
        return $throw
            ? throw $e
            : false;
    }
    if ($prop === null) {
        return false;
    }

    $prop->setAccessible(true);



    dde($type);

    try {

        $prop->setValue($object, $value);
    } catch (\Throwable $e) {
        return $throw
            ? throw $e
            : false;
    }
    return true;
}



$a = new class extends \ReflectionNamedType {
    function __toString()
    {
        return '';
    }
    function allowsNull(): bool
    {
        return true;
    }
    function getName(): string
    {
        return '';
    }
    function isBuiltin(): bool
    {
        return false;
    }
};

$a = new \ReflectionNamedType;

$closure = (function () {})->bindTo($a, $a);

$a->getName = $closure;

dde($a);

// $ref = Refl::_class($a);

// de($ref->getMethods());
$obj = new ClassicClass;
// $res = Refl::setValueProp($obj, 'publicPropBool', '');
$res = setValueProp($obj, '$testProp2', '', true);
dde($res);





de();
/**
 * @return \Generator<array{iter:int,posFrom:int,posTo:int},string>
 */
function toCharsGenerator(string $pathTofile, int $chunk = 1)
{
    if (!\is_file($pathTofile)) {
        throw new \Exception(\sprintf('Not found file: "%s"', $pathTofile));
    }

    $resource = \fopen($pathTofile, 'r');

    if ($resource === false) {
        throw new \Exception(\sprintf('Failed open file: "%s"', $pathTofile));
    }

    $iteration = 0;
    while (true) {
        $posFrom = \ftell($resource); // берем текущую позицию/указатель
        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $chars = \fread($resource, (10 * $chunk));
        if ($chars === false) {
            break;
        }
        $chars = \mb_substr($chars, 0, $chunk, 'UTF-8'); // из кусочка берем один символ
        \fseek($resource, ($posFrom + \strlen($chars))); // возвращаемся назад до того символна что взяли

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $posTo = \ftell($resource); // берем текущую позицию/указатель

        if ($posFrom === $posTo) {
            break;
        }

        yield [
            'iter'    => $iteration,
            'posFrom' => $posFrom,
            'posTo'   => $posTo,
        ] => $chars;

        $iteration++;
    }

    \fclose($resource);
}


foreach (toCharsGenerator('test.txt', 3) as $opt => $chars) {
    dd([
        $opt,
        $chars,
    ]);
}







de();
/**
 * @return \Closure(object|array &$array, callable $callable):void
 */
function walkRecursive()
{
    return static function (&$array, callable $callable) {
        $recursive = null;
        $state     = [
            'depth'       => 0,
            'prepend'     => '',
            'changedKeys' => [],
        ];
        /**
         * @param object|array $array
         * @param callable $callable
         * @param \Closure $recursive
         */
        $recursive = static function (&$array, $callable, $recursive) use (&$state) {
            foreach ($array as $key => &$value) {
                $dotKey = $state['prepend'] . $key;
                if ($state['changedKeys'] && \in_array($dotKey, $state['changedKeys'])) {
                    continue;
                }
                $beforeKey = $key;

                $callable($value, $key, $dotKey, $state['depth']);

                if ($beforeKey !== $key) {
                    $state['changedKeys'][] = $state['prepend'] . $key;
                    $array[$key] = $array[$beforeKey];
                    unset($array[$beforeKey]);
                }

                if (\is_iterable($value)) {
                    $state['depth']++;
                    $beforePrepend = $state['prepend'];
                    $state['prepend'] = $state['prepend'] . $key . '.';
                    $recursive->__invoke($value, $callable, $recursive);
                    $state['prepend'] = $beforePrepend;
                    $state['depth']--;
                }
            }
        };

        $recursive($array, $callable, $recursive);
    };
}




// ---------------------------------------------
// 
// ---------------------------------------------






$fruits = [
    'sweet' => [
        'a' => 'яблоко',
        'b' => 'банан'
    ],
    '123',
    'sweet2' => [
        'a2' => 'яблоко',
        'b2' => 'банан'
    ],
    'sour' => 'лимон',
    'sweet3' => [
        'a' => [
            'b' => [
                'final'
            ],
        ],
    ],
];






// d([
//     '$fruits' => $fruits
// ]);

walkRecursive()($fruits, static function (&$value, &$key, $dotKey, $depth) {
    d([
        '$value'  => $value,
        '$key'    => $key,
        '$dotKey'    => $dotKey,
        '$depth'    => $depth,
    ]);

    if ($key === 'sweet2') {
        $key = 'sweet22';
    }

    // if (\is_array($value)) {
    //     $value = [1, 2, 3];
    // }
});


de([
    '$fruits' => $fruits
]);


de();
dde(opcache_get_configuration());

de();
if (\function_exists('opcache_get_status')) {
    $opcacheStatus = \opcache_get_status(false);
    if ($opcacheStatus === false) {
        echo 'OPcache не включён или недоступен.';
    } else {
        echo 'OPcache включён.';
        // Дополнительная информация о состоянии OPcache
        print_r($opcacheStatus);
    }
} else {
    echo 'OPcache не установлен.';
}

de();
$a = File::cacheRead('awdadw', true);


dde($a);
set_time_limit(2);

sleep(5);

// zend_error_noreturn

// $a = File::put('123', '123');



de();
/**
 * @param string|\Closure|\ReflectionFunction $function
 */
function getArgs($function)
{
    if (!($function instanceof \ReflectionFunction)) {
        $function = new \ReflectionFunction($function);
    }
    de($function->__toString());
    $result = [];
    foreach ($function->getParameters() as $param) {
        $type = $param->getType();
        de($type);
        $classType = \get_class($type);
        if (\PHP_VERSION_ID >= 80000 && $type === 'ReflectionUnionType') {
            de($type->getTypes());
        }
        $result[$param->getName()] = ($type = $param->getType()) ? $type->getName() : 'mixed';
    }

    return $result;
}

// $a = static function((\Iterator&\stdClass)|string|(\IteratorIterator&\stdClass) $a, array $two, ...$list){

// };

$a = static function (array $a) {
    $a['ref'] = '123';
};

$a(['ref' => &$ref]);

de($ref);

// $res = getArgs($a);

de($res);



de();
set_error_handler(function () {
    echo 1;
});

set_error_handler(function () {
    echo 2;
    return true;
});

trigger_error('bla');


de();

// enum Test:int{
//     case ONE = 1;
// }


// echo Other::getType(Test::ONE);

de();

// dde(igbinary_serialize([11, 2, 3, 4, 5, 6]));

de();
$status = File::save(__DIR__ . '/test.txt', [11111, 2, 3, 4, 5, 6]);

dde($status);
// File::save(__DIR__ . '/text.txt', 'bla');
