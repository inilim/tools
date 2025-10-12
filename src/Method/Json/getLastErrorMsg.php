<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

/**
 * @return string
 */
function getLastErrorMsg()
{
    return \json_last_error_msg();
}
