<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Take the first or last {$limit} items from an array.
 *
 * @param  array  $array
 * @param  int  $limit
 * @return array
 */
function take($array, $limit)
{
    if ($limit < 0) {
        return \array_slice($array, $limit, \abs($limit));
    }

    return \array_slice($array, 0, $limit);
}
