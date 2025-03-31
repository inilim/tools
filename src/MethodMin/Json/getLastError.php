<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function getLastError(){return['code'=>\json_last_error(),'msg'=>\json_last_error_msg()];}