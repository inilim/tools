<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function isStatic($callable,$message=''){\Inilim\Tool\Method\Assert\isCallable($callable,$message);if(\is_string($callable)&&\function_exists($callable)){$reflection=new \ReflectionFunction($callable);}elseif($callable instanceof \Closure){$reflection=new \ReflectionFunction($callable);}else{$callable=\Closure :: fromCallable($callable);$reflection=new \ReflectionFunction($callable);}if(!$reflection -> isStatic()){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument($message?:'Closure is not static.');}return $callable;}if(!\Inilim\Tool\Assert::__definedIfNot('isCallable')){
    function isCallable($value,string $message=''){if(!\is_callable($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a callable. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}