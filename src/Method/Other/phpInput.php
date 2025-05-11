<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @return string
 */
function phpInput(): string
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => \file_get_contents('php://input'),
        null
    );

    if (\is_string($value)) {
        return $value;
    }
    return '';
}
