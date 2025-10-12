<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function isJsonAsObject(?string $v): bool
{
    if ($v === null) return false;
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\Inilim\Tool\Method\Json\hasError()) return false;
    return \is_object($v);
}
