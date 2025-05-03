<?php

namespace Inilim\Tool\Method\Json;

function isJsonAsNumeric(?string $v): bool
{
    if ($v === null) return false;
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\Inilim\Tool\Method\Json\hasError()) return false;

    return \Inilim\Tool\Method\Integer\isNumeric($v);
}
