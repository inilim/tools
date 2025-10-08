<?php

declare(strict_types=1);

use Inilim\Tool\Other;

use function Inilim\Tool\Method\Other\getType;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '5M');


__includeDeep([
    // 'Other\phpInfoCache',
    // 'Other\phpInfo',
]);

// \Inilim\Tool\Method\Other\phpInfoCache();

function test(): \Closure
{
    $opt = [
        'end'      => false,
        'count'    => 0,
        'file'     => '',
        'resource' => null,
    ];


    return static function ($value) use (&$opt) {

        $opt['count']++;


        dd($opt['count']);
    };
}

$gen = test();
$gen2 = test();

$gen('Привет1');
$gen('Привет2');
$gen2('Привет3');
// $gen(false);
// $gen('Привет4');
