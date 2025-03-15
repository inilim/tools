<?php

namespace Inilim\Tool\Method\Json;

/**
 * @return integer
 */
function getLastErrorCode()
{
    return \json_last_error();
}
