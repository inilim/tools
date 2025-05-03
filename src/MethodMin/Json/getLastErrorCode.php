<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function getLastErrorCode():int{return \json_last_error();}