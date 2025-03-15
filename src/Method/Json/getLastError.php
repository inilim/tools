<?php

namespace Inilim\Tool\Method\Json;

/**
 * @return array{code:int,msg:string}
 */
function getLastError()
{
    return [
        'code' => \json_last_error(),
        'msg'  => \json_last_error_msg(),
    ];
}
