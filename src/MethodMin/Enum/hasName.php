<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Enum{function hasName($enum,string $name,bool $caseInsensitive=false){return \Inilim\Tool\Method\Enum\tryFromName($enum,$name,$caseInsensitive)!==null;}if(!\Inilim\Tool\Enum::__definedIfNot('__uniform')){
    function __uniform($value,bool $caseInsensitive){return $caseInsensitive?\Inilim\Tool\Method\Str\lower(\strval($value)):$value;}
    }if(!\Inilim\Tool\Enum::__definedIfNot('cases')){
    function cases($enum){\Inilim\Tool\Method\Assert\php81();if(\Inilim\Tool\Method\Other\isEnum($enum)){return $enum :: cases();}throw new \InvalidArgumentException('Must be of type \UnitEnum');}
    }if(!\Inilim\Tool\Enum::__definedIfNot('tryFromName')){
    function tryFromName($enum,string $name,bool $caseInsensitive=false){foreach(\Inilim\Tool\Method\Enum\cases($enum)as $enum){if(\Inilim\Tool\Method\Enum\__uniform($enum -> name,$caseInsensitive)===\Inilim\Tool\Method\Enum\__uniform($name,$caseInsensitive)){return $enum;}}return null;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('isEnum')){
    function isEnum($v):bool{if(\PHP_VERSION_ID<80100){return false;}$t=\gettype($v);if($t==='object'){return $v instanceof \UnitEnum;}elseif($t==='string'){return \enum_exists($v);}return false;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('php81')){
    function php81(string $message=''){if(!\Inilim\Tool\Method\Check\php81()){throw new \InvalidArgumentException($message?:'The current version is lower than required "8.1"');}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}