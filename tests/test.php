<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

use Inilim\Tool\Arr;
use Inilim\Tool\Str;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\File;
use Inilim\Tool\Enum;
use Inilim\Tool\Json;
use Inilim\Tool\Refl;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use DragonCode\Benchmark\Benchmark;
use Inilim\Tool\Test\ForTest\ClassicClass;






__include('Other::backtrace');

class Staticc
{
    static $aaa = 123;
    static $bbb = 'aaa';
    static $ccc;

    static  function dawd()
    {
        $props = \Inilim\Tool\Method\Other\backtrace();
        dde($props);
    }

    static function wadwdw()
    {
        self::dawd();
    }
}


Staticc::wadwdw();


de();
