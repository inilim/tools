<?php

namespace Inilim\Tool\Method\Json;

/**
 * @return boolean
 */
function isJsonAsFloat(?string $v)
{
    if ($v === null) return false;
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\Inilim\Tool\Method\Json\hasError()) return false;
    return \is_float($v);
}
