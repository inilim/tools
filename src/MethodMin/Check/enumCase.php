<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function enumCase($v):bool{if(!\is_object($v)||\PHP_VERSION_ID<80100){return false;}return $v instanceof \UnitEnum;}