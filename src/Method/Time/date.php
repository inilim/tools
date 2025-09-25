<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @link https://php.net/manual/en/function.date.php
 */
function date(string $format, ?int $timestamp = null): ?string
{
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn() => \date($format, $timestamp), null);
    /** @var string|false $value */
    return $value === false ? null : $value;
}
