<?php

namespace Inilim\Method\Json;

function getLastErrorMsg(): string
{
    return \json_last_error_msg();
}
