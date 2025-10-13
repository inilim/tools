<?php

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\Assert;

// WeakMap php 8.0 and up

$items = new \WeakMap;
$items[$temp = new class {}] = 'bar';
Assert::same(['bar'], LarArr::from($items));
