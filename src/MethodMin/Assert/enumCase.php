<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function enumCase($value,string $message=''){if(\Inilim\Tool\Method\Enum\isCase($value)){return;}throw new \AssertionError($message?:'Expected an \UnitEnum');}}namespace Inilim\Tool\Method\Enum{if(!\Inilim\Tool\Enum::__definedIfNot('isCase')){
    function isCase($v):bool{if(\PHP_VERSION_ID<80100){return false;}return $v instanceof \UnitEnum;}
    }}