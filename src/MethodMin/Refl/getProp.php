<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Refl{function getProp($objectOrClass,string $name,bool $throw=false){$name=\Inilim\Tool\Method\Other\unprefixVar($name);$ref=\Inilim\Tool\Method\Refl\_class($objectOrClass,$throw);if($ref===null){return null;}try{return $ref -> getProperty($name);}catch(\ReflectionException $e){return $throw?throw $e:null;}}if(!\Inilim\Tool\Refl::__definedIfNot('_class')){
    function _class($classOrObj,bool $throw=false){try{return new \ReflectionClass($classOrObj);}catch(\ReflectionException $e){return $throw?throw $e:null;}}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null){if($charlist===null){$trimDefaultCharacters=" \n\r\t\v\x00";return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+|[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('unprefixVar')){
    function unprefixVar(string $name){return \Inilim\Tool\Method\Str\trim(\strtr($name,['static::$'=>'','$this->$'=>'','$this->'=>'','self::$'=>'','$'=>'']));}
    }}