<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Join all items using a string. The final items can use a separate glue string.
 */
function join(array $array, string $glue, string $finalGlue = ''): string
{
    if ($finalGlue === '') return \implode($glue, $array);

    if (!$array) return '';
    if (\sizeof($array) === 1) return \end($array);

    $finalItem = \array_pop($array);

    return \implode($glue, $array) . $finalGlue . $finalItem;
}
