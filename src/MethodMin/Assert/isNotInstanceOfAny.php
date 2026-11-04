<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function isNotInstanceOfAny($value,$classes,$message=''){\Inilim\Tool\Method\Assert\isIterable($classes);foreach($classes as $class){\Inilim\Tool\Method\Assert\string($class,'Expected class as a string. Got: %s');if($value instanceof $class){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected not an instance of %2$s. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value),\implode(', ',\array_map('\Inilim\Tool\Method\Other\valueToString',\iterator_to_array($classes)))));}}return $value;}if(!\Inilim\Tool\Assert::__definedIfNot('isIterable')){
    function isIterable($value,string $message=''){if(!\Inilim\Tool\Method\Check\isIterable($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected an iterable. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,$message=''){if(!\is_string($value)){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value)));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__typeToString')){
    function __typeToString($value):string{return \is_object($value)?\get_class($value):\gettype($value);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isIterable')){
    function isIterable($value):bool{return \is_iterable($value);}
    }}