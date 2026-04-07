<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @todo to check
 * @author Inilim
 * @param mixed $v
 */
function isEnum($v): bool
{
    if (\PHP_VERSION_ID < 80100) {
        return false;
    }
    $t = \gettype($v);
    if ($t === 'object') {
        /** @var object $v */
        return $v instanceof \UnitEnum;
    } elseif ($t === 'string') {
        /** @var string $v */
        return \enum_exists($v);
    }
    return false;
}
