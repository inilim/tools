<?php

namespace Inilim\Tool\Method\Other;

/**
 * @return string
 */
function phpInput()
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static function () {
        $value = \file_get_contents('php://input');
        if ($value === false) return '';
        return $value;
    }, null);

    if (\is_string($value)) {
        return $value;
    }
    return '';
}
