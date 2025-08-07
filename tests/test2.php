<?php

use Inilim\Tool\Arr;
use Inilim\Tool\Other;
use PhpParser\Node\Stmt\Break_;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

__include([
    'Str\limit',
    'Assert\isNonEmptyArray',
    'Assert\isArray',
]);


function array_map_optimize(array $array, array $instruction = []): array
{
    if (!$array) {
        return [];
    }

    // \Inilim\Tool\Method\Assert\isNonEmptyArray($instruction);

    foreach ($array as &$item) {
        foreach ($instruction as $fnName => $args) {
            switch ($fnName) {
                case 'strtolower':
                    $item = \strtolower($item);
                    break;
                case 'concatLeft':
                    $item = $args[0] . $item;
                    break;
                case 'concatRight':
                    $item .= $args[0];
                    break;
                case 'concatBoth':
                    $item = $args[0] . $item . $args[1] ?? $args[0];
                    break;
            } // endswitch
        }
    }

    return $array;
}

$array = [
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
    'awdawd',
];

$result = Other::timedMsCall(static function () use ($array) {
    for ($i = 0; $i < 10_000; $i++) {
        \array_map(static function ($item) {
            return \strtolower($item);
        }, $array);

        // array_map_optimize($array, [
        //     'strtolower' => [],
        // ]);
    }
});


de($result);
