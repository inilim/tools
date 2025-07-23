<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function isInstanceOfAny($value,array $classes,string $message=''){if(!\Inilim\Tool\Method\Check\isInstanceOfAny($value,$classes)){throw new \InvalidArgumentException(\sprintf($message?:'Expected an instance of any of %2$s. Got: %s',\Inilim\Tool\Method\Other\getType($value),\implode(', ',\array_map('\Inilim\Tool\Method\Other\valueToString',$classes))));}}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('funcPhp')){
    function funcPhp(string $function,bool $rechecking=false):bool{static $o=null;$o ??=[];$function=\ltrim($function,'\\');if(isset($o[$function])&&!$rechecking){return $o[$function];}return $o[$function]=\function_exists($function);}
    }if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v){$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}elseif($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':return 'bool';case 'integer':return 'int';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('valueToString')){
    function valueToString($value):string{if(null===$value){return 'null';}if(true===$value){return 'true';}if(false===$value){return 'false';}if(\is_array($value)){return 'array';}if(\is_object($value)){if(\method_exists($value,'__toString')){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> __toString());}if($value instanceof \DateTime||$value instanceof \DateTimeImmutable){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> format('c'));}if(\Inilim\Tool\Method\Other\funcPhp('enum_exists')&&\enum_exists(\get_class($value))){return \get_class($value).'::'.$value -> name;}return \get_class($value);}if(\is_resource($value)){return 'resource';}if(\is_string($value)){return '"'.$value.'"';}return (string) $value;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isInstanceOfAny')){
    function isInstanceOfAny($value,array $classes):bool{foreach($classes as $class){if($value instanceof $class){return true;}}return false;}
    }}