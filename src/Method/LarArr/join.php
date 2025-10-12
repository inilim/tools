<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Join all items using a string. The final items can use a separate glue string.
 *
 * @param  array  $array
 * @param  string  $glue
 * @param  string  $finalGlue
 * @return string
 */
function join($array, $glue, $finalGlue = '')
{
    if ($finalGlue === '') {
        return \implode($glue, $array);
    }

    if (\count($array) === 0) {
        return '';
    }

    if (\count($array) === 1) {
        return \Inilim\Tool\Method\PF\array_last($array);
    }

    $finalItem = \array_pop($array);

    return \implode($glue, $array) . $finalGlue . $finalItem;
}
