<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function httpHeaderValue($value,string $message=''){\Inilim\Tool\Method\Assert\string($value,$message?:'Header value must be a string but %s provided.');if(!\Inilim\Tool\Method\Check\httpHeaderValue($value)){throw new \InvalidArgumentException(\sprintf('"%s" is not valid header value.',$value));}}if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,string $message=''){if(!\is_string($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('httpHeaderValue')){
    function httpHeaderValue($value):bool{return \is_string($value)&&(bool) \preg_match('/^[\x20\x09\x21-\x7E\x80-\xFF]*$/D',$value);}
    }}