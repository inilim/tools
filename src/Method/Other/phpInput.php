<?php

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @return string
 */
function phpInput()
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static function () {
        return \file_get_contents('php://input');
    }, null);

    if (\is_string($value)) {
        return $value;
    }
    return '';
}
