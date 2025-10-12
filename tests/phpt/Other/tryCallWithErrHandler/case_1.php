<?php

use Inilim\Tool\Other;
use Inilim\Tool\Test\Assert;

$result = Other::tryCallWithErrHandler(
    static function () {
        \trigger_error('', \E_USER_ERROR);
        return 'result';
    },
    null
);

Assert::same('result', $result);

$result = Other::tryCallWithErrHandler(
    static function () {
        throw new \Exception();
        return 'result';
    },
    null
);

Assert::isNull($result);
