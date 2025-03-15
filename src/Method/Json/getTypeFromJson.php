<?php

namespace Inilim\Tool\Method\Json;

/**
 * gettype - вернет null если json не валидный
 * @return ?string
 */
function getTypeFromJson(?string $v)
{
    if ($v === null) return null;
    $v = \Inilim\Tool\Method\Json\decode($v, false);
    if (\Inilim\Tool\Method\Json\hasError()) return null;
    return \Inilim\Tool\Method\Other\getType($v);
}
