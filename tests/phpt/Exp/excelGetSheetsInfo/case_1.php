<?php

use Inilim\Tool\Exp;
use Inilim\Tool\Other;
use Inilim\Tool\Test\Assert;
use Inilim\Tool\Test\Internal;

$file = Internal::get_param_from_env('file');

Assert::isString($file);

$results = Exp::excelGetSheetsInfo($file);

Assert::isNull(Other::errorGetLast());
Assert::isArray($results);

foreach ($results as $result) {
    Assert::isArray($result);
    Assert::count(3, $result);

    Assert::arrayHasKey('id', $result);
    Assert::isString($result['id']);

    Assert::arrayHasKey('name', $result);
    Assert::isString($result['name']);

    Assert::arrayHasKey('state', $result);
    Assert::nullOrString($result['state']);
}
