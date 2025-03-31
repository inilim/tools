<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Refl{function setValueProp($objectOrClass,string $name,$value,bool $throw=false){$prop=\Inilim\Tool\Method\Refl\getProp($objectOrClass,$name,$throw);if($prop===null){return false;}$prop -> setAccessible(true);try{$prop -> setValue($objectOrClass,$value);}catch(\Throwable $e){return $throw?throw $e:false;}return true;}if(!\Inilim\Tool\Refl::__definedIfNot('_class')){
    function _class($objectOrClass,bool $throw=false){try{return new \ReflectionClass($objectOrClass);}catch(\ReflectionException $e){return $throw?throw $e:null;}}
    }if(!\Inilim\Tool\Refl::__definedIfNot('getProp')){
    function getProp($objectOrClass,string $name,bool $throw=false){$name=\Inilim\Tool\Method\Other\unprefixVar($name);$ref=\Inilim\Tool\Method\Refl\_class($objectOrClass,$throw);if($ref===null){return null;}try{return $ref -> getProperty($name);}catch(\ReflectionException $e){return $throw?throw $e:null;}}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null){if($charlist===null){return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}]+|[\s\x{FEFF}\x{200B}\x{200E}]+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('unprefixVar')){
    function unprefixVar(string $name){return \Inilim\Tool\Method\Str\trim(\strtr($name,['$'=>'','$this->$'=>'','$this->'=>'','self::$'=>'','static::$'=>'']));}
    }}