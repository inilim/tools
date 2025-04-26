<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum{function tryFromValue($enum,$value,bool $caseInsensitive=false){$backed=false;foreach(\Inilim\Tool\Method\Enum\cases($enum)as $enum){if(!$backed&&!$backed=$enum instanceof \BackedEnum){return null;}if(\Inilim\Tool\Method\Enum\__uniform($enum -> value,$caseInsensitive)===\Inilim\Tool\Method\Enum\__uniform($value,$caseInsensitive)){return $enum;}}return null;}if(!\Inilim\Tool\Enum::__definedIfNot('__uniform')){
    function __uniform($value,bool $caseInsensitive){return $caseInsensitive?\Inilim\Tool\Method\Str\lower(\strval($value)):$value;}
    }if(!\Inilim\Tool\Enum::__definedIfNot('cases')){
    function cases($enum){\Inilim\Tool\Method\Assert\php81();if(\Inilim\Tool\Method\Other\isEnum($enum)){return $enum :: cases();}throw new \InvalidArgumentException('Must be of type \UnitEnum');}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('isEnum')){
    function isEnum($v){if(\PHP_VERSION_ID<80100){return false;}if(\is_object($v)){return $v instanceof \UnitEnum;}elseif(\is_string($v)){return \enum_exists($v);}return false;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('php81')){
    function php81(string $message=''){if(\Inilim\Tool\Method\Check\php81()){return;}throw new \AssertionError($message?:'The current version is lower than required "8.1"');}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81(){return \PHP_VERSION_ID>=80100?true:false;}
    }}