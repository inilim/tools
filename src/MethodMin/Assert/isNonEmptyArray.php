<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function isNonEmptyArray($value,string $message=''){\Inilim\Tool\Method\Assert\isArray($value);if(empty($value)){throw new \InvalidArgumentException($message?:'Expected a non-empty array.');}}if(!\Inilim\Tool\Assert::__definedIfNot('isArray')){
    function isArray($value,string $message=''){if(!\is_array($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a array. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}