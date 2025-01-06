<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @internal Inilim\Tool\Method\Integer
 * @param string[] $value
 * @param int[] $arrayInt
 * @return bool
 */
function __compare(array $value, array $arrayInt)
{
    foreach (\array_map(null, $value, $arrayInt) as $c) {
        list($v, $a) = $c;
        $v = \intval($v);
        if ($v > $a) return false;
        elseif ($v < $a) return true;
    }
    return true;
}
