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

class Test
{
    function __get($name)
    {
        return static function () {
            echo 123;
        };
    }
}

$a = new Test;

$a->name();
