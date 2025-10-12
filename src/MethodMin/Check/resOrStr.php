<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function resOrStr($value,?string $type=null):bool{if(\is_string($value)){return true;}if(!\is_resource($value)){return false;}if($type!==null&&$type!==\get_resource_type($value)){return false;}return true;}