<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function allNullOrIsCallable($value,string $message=''){\Inilim\Tool\Method\Assert\isIterable($value);foreach($value as $entry){null===$entry||\Inilim\Tool\Method\Assert\isCallable($entry,$message);}}if(!\Inilim\Tool\Assert::__definedIfNot('isCallable')){
    function isCallable($value,string $message=''){if(!\is_callable($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a callable. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('isIterable')){
    function isIterable($value,string $message=''){if(!\Inilim\Tool\Method\Check\isIterable($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected an iterable. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isIterable')){
    function isIterable($value):bool{return \is_iterable($value);}
    }}