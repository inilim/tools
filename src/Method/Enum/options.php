<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

/**
 * @author Inilim
 * @template T of \UnitEnum
 * @param class-string<T>|T $enum
 * @return string[]|array<string,string|int>
 */
function options($enum)
{
    $cases = \Inilim\Tool\Method\Enum\cases($enum);
    if (isset($cases[0]->value)) {
        return \array_column($cases, 'value', 'name');
    }
    return \array_column($cases, 'name');
}
