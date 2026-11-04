<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function uniqueValues($values,$message=''):array{\Inilim\Tool\Method\Assert\isArray($values);$allValues=\count($values);$uniqueValues=\count(\array_unique($values,\SORT_REGULAR));if($allValues!==$uniqueValues){$difference=$allValues-$uniqueValues;$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected an array of unique values, but %s of them %s duplicated',$difference,1===$difference?'is':'are'));}return $values;}if(!\Inilim\Tool\Assert::__definedIfNot('isArray')){
    function isArray($value,string $message=''){if(!\is_array($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a array. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}