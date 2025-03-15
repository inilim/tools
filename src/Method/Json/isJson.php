<?php

namespace Inilim\Tool\Method\Json;

/**
 * @return boolean
 */
function isJson(?string $v)
{
    if ($v === null) return false;
    if (\PHP_VERSION_ID >= 80300) {
        return \json_validate($v);
    }
    \Inilim\Tool\Method\Json\decode($v);
    return !\Inilim\Tool\Method\Json\hasError();
}
