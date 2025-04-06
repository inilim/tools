<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum{function firstValue($enum){$case=\Inilim\Tool\Method\Enum\head($enum);return $case -> value ?? null;}if(!\Inilim\Tool\Enum::__definedIfNot('cases')){
    function cases($enum){\Inilim\Tool\Method\Assert\php81();if(\Inilim\Tool\Method\Other\isEnum($enum)){return $enum :: cases();}throw new \InvalidArgumentException('Must be of type \UnitEnum');}
    }if(!\Inilim\Tool\Enum::__definedIfNot('head')){
    function head($enum){return \Inilim\Tool\Method\Arr\head(\Inilim\Tool\Method\Enum\cases($enum));}
    }}namespace Inilim\Tool\Method\Arr{if(!\Inilim\Tool\Arr::__definedIfNot('head')){
    function head(array $array){return \reset($array);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('isEnum')){
    function isEnum($v){if(\PHP_VERSION_ID<80100){return false;}if(\is_object($v)){return $v instanceof \UnitEnum;}elseif(\is_string($v)){return \enum_exists($v);}return false;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('php81')){
    function php81(string $message=''){if(\PHP_VERSION_ID>=80100){return;}throw new \AssertionError($message?:'The current version is lower than required "8.1"');}
    }}