<?php

namespace Inilim\Method\Json;

function getLastErrorCode(): int
{
    return \json_last_error();
}
