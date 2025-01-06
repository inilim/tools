<?php

namespace Inilim\Tool\Method\Json;

function getLastErrorCode(): int
{
    return \json_last_error();
}
