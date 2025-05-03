<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function hasError():bool{return \json_last_error()!==\JSON_ERROR_NONE;}