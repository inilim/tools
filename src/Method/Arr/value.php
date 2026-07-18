<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use Lar::***
 * @author laravel
 * Return the default value of the given value.
 *
 * @template TValue
 * @template TArgs
 *
 * @param  TValue|\Closure(TArgs): TValue  $value
 * @param  TArgs  ...$args
 * @return TValue
 */
function value($value, ...$args)
{
    return $value instanceof \Closure ? $value(...$args) : $value;
}
