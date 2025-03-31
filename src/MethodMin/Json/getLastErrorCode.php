<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function getLastErrorCode(){return \json_last_error();}