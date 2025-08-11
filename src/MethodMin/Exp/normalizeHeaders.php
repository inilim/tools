<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp{function normalizeHeaders(array $headers):array{if(!$headers){return[];}$lines=[];$nameCompleted=[];foreach($headers as $name=>&$values){if(isset($nameCompleted[$name])){continue;}if(\is_string($values)){if(\is_string($name)){$values=[$values];}else{$lines[]=$values;unset($headers[$name]);continue;}}\Inilim\Tool\Method\Assert\httpHeaderName($name);foreach($values as $value){\Inilim\Tool\Method\Assert\httpHeaderValue($value);}$newName=\strtolower($name);if($newName!==$name){$headers[$newName]=$values;unset($headers[$name]);}$nameCompleted[$name]=true;}if($lines){foreach(\Inilim\Tool\Method\Exp\headersFromLines($lines)as $name=>$values){$name=\strtolower($name);if(isset($headers[$name])){$headers[$name]=\array_merge($headers[$name],$values);}else{$headers[$name]=$values;}}}return $headers;}if(!\Inilim\Tool\Exp::__definedIfNot('headersFromLines')){
    function headersFromLines(iterable $lines):array{$headers=[];foreach($lines as $line){if($line===''){continue;}\Inilim\Tool\Method\Assert\contains($line,':');[$name,$values]=\explode(':',$line,2);$name=\trim($name);\Inilim\Tool\Method\Assert\httpHeaderName($name);if(\Inilim\Tool\Method\PF\str_contains($values,',')){$values=\explode(',',$values);}else{$values=[$values];}$headers[$name]??=[];foreach($values as $value){\Inilim\Tool\Method\Assert\httpHeaderValue($value);$headers[$name][]=\trim($value);}}return $headers;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('iContainsOnce')){
    function iContainsOnce(string $haystack,string $needle):bool{return ''===$needle||\mb_stripos($haystack,$needle,0,'UTF-8')!==false;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('valueToString')){
    function valueToString($value):string{$type=\Inilim\Tool\Method\Other\getType($value,true);if($type==='string'){return '"'.$value.'"';}if(\in_array($type,['true','false','null','resource','resource_closed','array'])){return $type;}if(\in_array($type,['object','exception'])){if(\method_exists($value,'__toString')){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> __toString());}if($value instanceof \DateTime||$value instanceof \DateTimeImmutable){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> format('c'));}return \get_class($value);}if($type==='enum'){if(\enum_exists(\get_class($value))){return \get_class($value).'::'.$value -> name;}return \get_class($value);}return (string) $value;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('contains')){
    function contains($value,string $subString,bool $ingnoreCase=false,string $message=''){\Inilim\Tool\Method\Assert\string($value);if(!\Inilim\Tool\Method\Check\contains($value,$subString,$ingnoreCase)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a value to contain %2$s. Got: %s',\Inilim\Tool\Method\Other\valueToString($value),\Inilim\Tool\Method\Other\valueToString($subString)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('httpHeaderName')){
    function httpHeaderName($value,string $message=''){\Inilim\Tool\Method\Assert\string($value,$message?:'Header name must be a string but %s provided.');if(!\Inilim\Tool\Method\Check\httpHeaderName($value)){throw new \InvalidArgumentException(\sprintf($message?:'"%s" is not valid header name.',$value));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('httpHeaderValue')){
    function httpHeaderValue($value,string $message=''){\Inilim\Tool\Method\Assert\string($value,$message?:'Header value must be a string but %s provided.');if(!\Inilim\Tool\Method\Check\httpHeaderValue($value)){throw new \InvalidArgumentException(\sprintf('"%s" is not valid header value.',$value));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,string $message=''){if(!\is_string($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('contains')){
    function contains($value,string $subString,bool $ingnoreCase=false):bool{return \is_string($value)&&($ingnoreCase?\Inilim\Tool\Method\Str\iContainsOnce($value,$subString):\Inilim\Tool\Method\PF\str_contains($value,$subString));}
    }if(!\Inilim\Tool\Check::__definedIfNot('httpHeaderName')){
    function httpHeaderName($value):bool{return \is_string($value)&&(bool) \preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/D',$value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('httpHeaderValue')){
    function httpHeaderValue($value):bool{return \is_string($value)&&(bool) \preg_match('/^[\x20\x09\x21-\x7E\x80-\xFF]*$/D',$value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}