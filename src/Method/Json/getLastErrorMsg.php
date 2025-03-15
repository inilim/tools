<?php

namespace Inilim\Tool\Method\Json;

/**
 * @return string
 */
function getLastErrorMsg()
{
    return \json_last_error_msg();
}
