<?php

namespace Inilim\Tool\Method\Json;

/**
 * @template T of mixed
 * @param T $default
 * @return list<mixed>|T
 */
function tryDecodeAsArrList(?string $v, $default = null)
{
    if ($v === null) {
        return $default;
    }
    $v = \Inilim\Tool\Method\Json\decode($v);
    if (\is_array($v) && \Inilim\Tool\Method\Arr\isList($v)) {
        return $v;
    }
    return $default;
}
