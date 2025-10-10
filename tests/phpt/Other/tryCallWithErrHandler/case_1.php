<?php

use Inilim\Tool\Other;

$result = Other::tryCallWithErrHandler(
    static function () {
        \trigger_error('', \E_USER_ERROR);
        return 'result';
    },
    null
);

\assertSame('result', $result);

$result = Other::tryCallWithErrHandler(
    static function () {
        throw new \Exception();
        return 'result';
    },
    null
);

\assertSame(null, $result);
