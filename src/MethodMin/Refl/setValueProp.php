<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Refl{function setValueProp($objectOrClass,string $name,$value,bool $throw=false):bool{$prop=\Inilim\Tool\Method\Refl\getProp($objectOrClass,$name,$throw);if($prop===null){return false;}$prop -> setAccessible(true);try{$prop -> setValue($objectOrClass,$value);}catch(\Throwable $e){if($throw){throw $e;}return null;}return true;}if(!\Inilim\Tool\Refl::__definedIfNot('_class')){
    function _class($classOrObj,bool $throw=false){try{return new \ReflectionClass($classOrObj);}catch(\ReflectionException $e){if($throw){throw $e;}return null;}}
    }if(!\Inilim\Tool\Refl::__definedIfNot('getProp')){
    function getProp($objectOrClass,string $name,bool $throw=false){$name=\Inilim\Tool\Method\Other\unprefixVar($name);$ref=\Inilim\Tool\Method\Refl\_class($objectOrClass,$throw);if($ref===null){return null;}try{$prop=$ref -> getProperty($name);if(!\Inilim\Tool\Method\Check\php81()){$prop -> setAccessible(true);}return $prop;}catch(\ReflectionException $e){if($throw){throw $e;}return null;}}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ??= new class{const INVISIBLE_CHARACTERS='\x{0009}\x{0020}\x{00A0}\x{00AD}\x{034F}\x{061C}\x{115F}\x{1160}\x{17B4}\x{17B5}\x{180E}\x{2000}\x{2001}\x{2002}\x{2003}\x{2004}\x{2005}\x{2006}\x{2007}\x{2008}\x{2009}\x{200A}\x{200B}\x{200C}\x{200D}\x{200E}\x{200F}\x{202F}\x{205F}\x{2060}\x{2061}\x{2062}\x{2063}\x{2064}\x{2065}\x{206A}\x{206B}\x{206C}\x{206D}\x{206E}\x{206F}\x{3000}\x{2800}\x{3164}\x{FEFF}\x{FFA0}\x{1D159}\x{1D173}\x{1D174}\x{1D175}\x{1D176}\x{1D177}\x{1D178}\x{1D179}\x{1D17A}\x{E0020}';var $randomStringFactory;};}
    }if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null):string{if($charlist===null){$trimDefaultCharacters=\preg_quote(" \n\r\t\v\x00");$c=\Inilim\Tool\Method\Str\__state():: INVISIBLE_CHARACTERS;return \preg_replace('~^[\s'.$c.$trimDefaultCharacters.']+|[\s'.$c.$trimDefaultCharacters.']+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('unprefixVar')){
    function unprefixVar(string $name){return \Inilim\Tool\Method\Str\trim(\strtr($name,['static::$'=>'','$this->$'=>'','$this->'=>'','self::$'=>'','$'=>'']));}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}