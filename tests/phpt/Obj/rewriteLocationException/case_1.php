<?php

use Inilim\Tool\Obj;
use Inilim\Tool\Test\Assert;

$e = new \Exception();

Obj::rewriteLocationException($e, 'My File', 777);

Assert::same('My File', $e->getFile());
Assert::same(777, $e->getLine());
