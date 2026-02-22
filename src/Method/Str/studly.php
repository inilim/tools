<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert a value to studly caps case.
 * @todo почемуто не отрабатывает callable как строка с namespace. function_exists выдает false, хотя функция входит в бандл
 * @return ($value is '' ? '' : string)
 */
function studly(string $value)
{
    $words = \explode(' ', \Inilim\Tool\Method\Str\replace(['-', '_'], ' ', $value));

    // @deps(\Inilim\Tool\Method\Str\ucfirst)
    $studlyWords = \array_map(
        '\Inilim\Tool\Method\Str\ucfirst',
        $words
    );

    return \implode($studlyWords);
}
