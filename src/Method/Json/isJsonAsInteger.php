<?php

namespace Inilim\Tool\Method\Json;

/**
 * @return bool
 */
function isJsonAsInteger(?string $v)
{
    if ($v === null) return false;
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\Inilim\Tool\Method\Json\hasError()) return false;
    return \is_int($v);
}
