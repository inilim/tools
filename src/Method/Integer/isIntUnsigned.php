<?php

namespace Inilim\Tool\Method\Integer;

use Inilim\Tool\Integer;

Integer::__include([
    'isNumeric',
    'lenNumeric',
    '__compare',
]);
\Inilim\Tool\Str::__include('_startsWith');

/**
 * 0 <> 4_294_967_295
 * @param mixed $v
 * @return bool
 */
function isIntUnsigned($v)
{
    if (!isNumeric($v)) return false;
    /** @var int|string $v */
    $v = \strval($v);
    /** @var string $v */
    if (\Inilim\Tool\Method\String\_startsWith($v, '-')) return false;
    $len = lenNumeric($v);
    if ($len < Integer::MAX_LEN_32_BIT) return true;
    if ($len > Integer::MAX_LEN_32_BIT) return false;
    // длина 10
    return __compare(\str_split($v), [4, 2, 9, 4, 9, 6, 7, 2, 9, 5]);
}
