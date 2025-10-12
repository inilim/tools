<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function contains($value,string $subString,bool $ingnoreCase=false,string $message=''){\Inilim\Tool\Method\Assert\string($value);if(!\Inilim\Tool\Method\Check\contains($value,$subString,$ingnoreCase)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a value to contain %2$s. Got: %s',\Inilim\Tool\Method\Other\valueToString($value),\Inilim\Tool\Method\Other\valueToString($subString)));}}if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,string $message=''){if(!\is_string($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('iContainsOnce')){
    function iContainsOnce(string $haystack,string $needle):bool{return ''===$needle||\mb_stripos($haystack,$needle,0,'UTF-8')!==false;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('valueToString')){
    function valueToString($value):string{$type=\Inilim\Tool\Method\Other\getType($value,true);if($type==='string'){return '"'.$value.'"';}if(\in_array($type,['true','false','null','resource','resource_closed','array'])){return $type;}if(\in_array($type,['object','exception'])){if(\method_exists($value,'__toString')){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> __toString());}if($value instanceof \DateTime||$value instanceof \DateTimeImmutable){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> format('c'));}return \get_class($value);}if($type==='enum'){if(\enum_exists(\get_class($value))){return \get_class($value).'::'.$value -> name;}return \get_class($value);}return (string) $value;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('contains')){
    function contains($value,string $subString,bool $ingnoreCase=false):bool{return \is_string($value)&&($ingnoreCase?\Inilim\Tool\Method\Str\iContainsOnce($value,$subString):\Inilim\Tool\Method\PF\str_contains($value,$subString));}
    }if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}