<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * php://input
 * @author Inilim
 */
function phpInput(): string
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => \file_get_contents('php://input'),
        null
    );
    return \is_string($value) ? $value : '';
}
