<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function isNonEmptyList($array,$message=''):array{\Inilim\Tool\Method\Assert\isList($array,$message);\Inilim\Tool\Method\Assert\notEmpty($array,$message);return $array;}if(!\Inilim\Tool\Assert::__definedIfNot('isList')){
    function isList($array,$message=''):array{if(!\Inilim\Tool\Method\Check\isList($array)){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument($message?:'Expected list - non-associative array.');}return $array;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('notEmpty')){
    function notEmpty($value,$message=''){if(!\Inilim\Tool\Method\Check\notEmpty($value)){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected a non-empty value. Got: %s',\Inilim\Tool\Method\Other\valueToString($value)));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('valueToString')){
    function valueToString($value):string{$type=\Inilim\Tool\Method\Other\getType($value,true);if($type==='string'){return '"'.$value.'"';}if(\in_array($type,['true','false','null','resource','resource_closed','array'])){return $type;}if(\in_array($type,['object','exception'])){if(\method_exists($value,'__toString')){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> __toString());}if($value instanceof \DateTime||$value instanceof \DateTimeImmutable){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> format('c'));}return \get_class($value);}if($type==='enum'){if(\enum_exists(\get_class($value))){return \get_class($value).'::'.$value -> name;}return \get_class($value);}return (string) $value;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isList')){
    function isList($value):bool{return \is_array($value)&&\Inilim\Tool\Method\PF\array_is_list($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('notEmpty')){
    function notEmpty($value):bool{return!empty($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_is_list')){
    function array_is_list(array $array):bool{if(\Inilim\Tool\Method\Check\php81()){return \array_is_list($array);}if([]===$array||$array===\array_values($array)){return true;}$nextKey=-1;foreach($array as $k=>$v){if($k!==++$nextKey){return false;}}return true;}
    }}