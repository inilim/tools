<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function maxCount($array,$max,$message=''){\Inilim\Tool\Method\Assert\isCountable($array);\Inilim\Tool\Method\Assert\integerish($max);if(\count($array)>$max){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected an array to contain at most %2$d elements. Got: %d',\count($array),$max));}return $array;}if(!\Inilim\Tool\Assert::__definedIfNot('integerish')){
    function integerish($value,$message=''){if(!\is_numeric($value)||$value!=(int) $value){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected an integerish value. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value)));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('isCountable')){
    function isCountable($value,string $message=''){if(!\Inilim\Tool\Method\Check\countable($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a countable. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__typeToString')){
    function __typeToString($value):string{return \is_object($value)?\get_class($value):\gettype($value);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('countable')){
    function countable($value):bool{if(!\is_array($value)&&!$value instanceof \Countable&&!$value instanceof \ResourceBundle&&!$value instanceof \SimpleXMLElement){return false;}return true;}
    }}