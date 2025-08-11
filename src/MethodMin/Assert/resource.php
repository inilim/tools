<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function resource($value,?string $type=null,string $message=''){if($type!==null&&!\Inilim\Tool\Method\Check\resource($value,$type)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a resource of type %2$s. Got: %s',\Inilim\Tool\Method\Other\getType($value),$type));}if(!\Inilim\Tool\Method\Check\resource($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a resource. Got: %s',\Inilim\Tool\Method\Other\getType($value),$type));}}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('resource')){
    function resource($value,?string $type=null):bool{if(!\is_resource($value)){return false;}if($type&&$type!==\get_resource_type($value)){return false;}return true;}
    }}