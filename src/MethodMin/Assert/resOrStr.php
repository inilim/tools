<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function resOrStr($value,?string $type=null,string $message=''){if($type!==null&&!\Inilim\Tool\Method\Check\resOrStr($value,$type)){throw new \InvalidArgumentException(\sprintf($message?:'Expected resource of type %2$s or string. Got: %s',\Inilim\Tool\Method\Other\getType($value),$type));}if(!\Inilim\Tool\Method\Check\resOrStr($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected resource or string. Got: %s',\Inilim\Tool\Method\Other\getType($value),$type));}}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('resOrStr')){
    function resOrStr($value,?string $type=null):bool{if(\is_string($value)){return true;}if(!\is_resource($value)){return false;}if($type!==null&&$type!==\get_resource_type($value)){return false;}return true;}
    }}