<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function isMap($array,$message=''):array{\Inilim\Tool\Method\Assert\isArray($array,$message);if(\count($array)>0&&\Inilim\Tool\Method\Check\isList($array)){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument($message?:'Expected map - associative array with string keys.');}return $array;}if(!\Inilim\Tool\Assert::__definedIfNot('isArray')){
    function isArray($value,string $message=''){if(!\is_array($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a array. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isList')){
    function isList($value):bool{return \is_array($value)&&\Inilim\Tool\Method\PF\array_is_list($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_is_list')){
    function array_is_list(array $array):bool{if(\Inilim\Tool\Method\Check\php81()){return \array_is_list($array);}if([]===$array||$array===\array_values($array)){return true;}$nextKey=-1;foreach($array as $k=>$v){if($k!==++$nextKey){return false;}}return true;}
    }}