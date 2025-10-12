<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * @internal Inilim\Tool\Method\Integer
 * @param string[] $value
 * @param int[] $arrayInt
 */
function __compare(array $value, array $arrayInt): bool
{
    foreach (\array_map(null, $value, $arrayInt) as $c) {
        [$v, $a] = $c;
        $v = \intval($v);
        if ($v > $a) {
            return false;
        } elseif ($v < $a) {
            return true;
        }
    }
    return true;
}
