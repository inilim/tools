<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function minLength($value,$min,$message=''):string{\Inilim\Tool\Method\Assert\string($value);\Inilim\Tool\Method\Assert\integerish($min);if(\Inilim\Tool\Method\Assert\__strlen($value)<$min){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected a value to contain at least %2$s characters. Got: %s',\Inilim\Tool\Method\Other\valueToString($value),$min));}return $value;}if(!\Inilim\Tool\Assert::__definedIfNot('integerish')){
    function integerish($value,$message=''){if(!\is_numeric($value)||$value!=(int) $value){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected an integerish value. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value)));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,$message=''){if(!\is_string($value)){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value)));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__strlen')){
    function __strlen(string $value):int{if(!\function_exists('mb_detect_encoding')){return \strlen($value);}if(false===$encoding=\mb_detect_encoding($value)){return \strlen($value);}return \mb_strlen($value,$encoding);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__typeToString')){
    function __typeToString($value):string{return \is_object($value)?\get_class($value):\gettype($value);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('valueToString')){
    function valueToString($value):string{$type=\Inilim\Tool\Method\Other\getType($value,true);if($type==='string'){return '"'.$value.'"';}if(\in_array($type,['true','false','null','resource','resource_closed','array'])){return $type;}if(\in_array($type,['object','exception'])){if(\method_exists($value,'__toString')){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> __toString());}if($value instanceof \DateTime||$value instanceof \DateTimeImmutable){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> format('c'));}return \get_class($value);}if($type==='enum'){if(\enum_exists(\get_class($value))){return \get_class($value).'::'.$value -> name;}return \get_class($value);}return (string) $value;}
    }}