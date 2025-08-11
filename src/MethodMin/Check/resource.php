<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function resource($value,?string $type=null):bool{if(!\is_resource($value)){return false;}if($type&&$type!==\get_resource_type($value)){return false;}return true;}