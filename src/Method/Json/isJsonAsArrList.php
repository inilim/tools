<?php

namespace Inilim\Tool\Method\Json;

/**
 * @return bool
 */
function isJsonAsArrList(?string $v)
{
    if ($v === null) return false;
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (
        \Inilim\Tool\Method\Json\hasError()
        || !\is_array($v)
        || !\Inilim\Tool\Method\Arr\isList($v)
    ) return false;
    return true;
}
