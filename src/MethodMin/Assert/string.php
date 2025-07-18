<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function string($value,string $message=''){if(!\is_string($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v){$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}elseif($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':return 'bool';case 'integer':return 'int';default:return $r;}}
    }}