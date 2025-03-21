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

Dump::init();


de();
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

$obj = new \stdClass;
$obj->key1 = 'value1';
$obj->key2 = 'value2';
$obj->key3 = 'value3';



/**
 * @param object|array $array
 */
function walkRecursive(&$array, callable $callable)
{
    $recursive = null;
    $state     = [
        'depth'         => 0,
        'dotKey'        => '',
        'prepend'       => '',
        'beforePrepend' => '',
        // 't'      => [],
    ];
    /**
     * @param object|array $array
     * @param callable $callable
     * @param \Closure $recursive
     */
    $recursive = static function (&$array, $callable, $recursive) use (&$state) {
        foreach ($array as $key => &$value) {
            $beforeKey       = $key;
            $state['dotKey'] = $state['prepend'] . $key;

            $dotKey = $state['dotKey'];
            $callable($value, $key, $dotKey);

            if ($beforeKey !== $key) {
                $array[$key] = $array[$beforeKey];
                unset($array[$beforeKey]);
            }

            // $array[$key] = $value;

            if (\is_iterable($value)) {
                $state['depth']++;
                $state['beforePrepend'] = $state['prepend'];
                $state['prepend']       = $state['prepend'] . $key . '.';
                $recursive->__invoke($value, $callable, $recursive);
                $state['prepend'] = $state['beforePrepend'];
                $state['depth']--;
            }
        }
    };

    $recursive->__invoke($array, $callable, $recursive);
}

d([
    '$fruits' => $fruits
]);

walkRecursive($fruits, static function (&$value, &$key, &$dotKey) {
    d([
        '$value'  => $value,
        '$key'    => $key,
        '$dotKey' => $dotKey,
    ]);

    if ($dotKey === 'sweet2.b2') {
        $dotKey = '';
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
