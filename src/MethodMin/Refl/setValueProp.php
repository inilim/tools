<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Refl{function setValueProp($objectOrClass,string $name,$value,bool $throw=false):bool{$prop=\Inilim\Tool\Method\Refl\getProp($objectOrClass,$name,$throw);if($prop===null){return false;}$prop -> setAccessible(true);try{$prop -> setValue($objectOrClass,$value);}catch(\Throwable $e){if($throw){throw $e;}return null;}return true;}if(!\Inilim\Tool\Refl::__definedIfNot('_class')){
    function _class($classOrObj,bool $throw=false){try{return new \ReflectionClass($classOrObj);}catch(\ReflectionException $e){if($throw){throw $e;}return null;}}
    }if(!\Inilim\Tool\Refl::__definedIfNot('getProp')){
    function getProp($objectOrClass,string $name,bool $throw=false){$name=\Inilim\Tool\Method\Other\unprefixVar($name);$ref=\Inilim\Tool\Method\Refl\_class($objectOrClass,$throw);if($ref===null){return null;}try{$prop=$ref -> getProperty($name);if(!\Inilim\Tool\Method\Check\php81()){$prop -> setAccessible(true);}return $prop;}catch(\ReflectionException $e){if($throw){throw $e;}return null;}}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null):string{if($charlist===null){$trimDefaultCharacters=\preg_quote(" \n\r\t\v\x00");return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+|[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('unprefixVar')){
    function unprefixVar(string $name){return \Inilim\Tool\Method\Str\trim(\strtr($name,['static::$'=>'','$this->$'=>'','$this->'=>'','self::$'=>'','$'=>'']));}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}