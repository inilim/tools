<?php

namespace Inilim\Tool\Method\Json;

function hasError(): bool
{
    return \json_last_error() !== \JSON_ERROR_NONE;
}
