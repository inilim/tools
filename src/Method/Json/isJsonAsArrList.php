<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function isJsonAsArrList(?string $v): bool
{
    if ($v === null) {
        return false;
    }
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (
        \Inilim\Tool\Method\Json\hasError()
        || !\is_array($v)
        || !\Inilim\Tool\Method\PF\array_is_list($v)
    ) return false;
    return true;
}
