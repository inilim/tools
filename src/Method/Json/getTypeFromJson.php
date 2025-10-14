<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

/**
 * вернет null если json не валидный
 * @return ?string
 */
function getTypeFromJson(?string $v): ?string
{
    if ($v === null) {
        return null;
    }
    $v = \Inilim\Tool\Method\Json\decode($v, false);
    if (\Inilim\Tool\Method\Json\hasError()) {
        return null;
    }
    return \Inilim\Tool\Method\Other\getType($v);
}
