<?php

namespace Inilim\Tool\Method\Json;

/**
 * @deprecated use Check::isJson()
 */
function isJson(?string $v): bool
{
    if ($v === null) {
        return false;
    }
    return \Inilim\Tool\Method\PF\json_validate($v);
}
