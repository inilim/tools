<?php

use Inilim\Tool\Arr;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

$test = [];

// $get = Arr::__asClosure('get');
Arr::get($test, 1);

deUsage();
