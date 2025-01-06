<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Join all items using a string. The final items can use a separate glue string.
 */
function join(array $array, string $glue, string $final_glue = ''): string
{
    if ($final_glue === '') return \implode($glue, $array);

    if (!$array) return '';
    if (\sizeof($array) === 1) return \end($array);

    $finalItem = \array_pop($array);

    return \implode($glue, $array) . $final_glue . $finalItem;
}
