<?php

namespace Inilim\Method\Json;

/**
 * @return bool
 */
function hasError()
{
    return \json_last_error() !== \JSON_ERROR_NONE;
}
