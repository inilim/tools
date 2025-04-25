<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum{function options($enum){$cases=\Inilim\Tool\Method\Enum\cases($enum);if(isset($cases[0]-> value)){return \array_column($cases,'value','name');}return \array_column($cases,'name');}if(!\Inilim\Tool\Enum::__definedIfNot('cases')){
    function cases($enum){\Inilim\Tool\Method\Assert\php81();if(\Inilim\Tool\Method\Other\isEnum($enum)){return $enum :: cases();}throw new \InvalidArgumentException('Must be of type \UnitEnum');}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('isEnum')){
    function isEnum($v){if(\PHP_VERSION_ID<80100){return false;}if(\is_object($v)){return $v instanceof \UnitEnum;}elseif(\is_string($v)){return \enum_exists($v);}return false;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('php81')){
    function php81(string $message=''){if(\Inilim\Tool\Method\Check\php81()){return;}throw new \AssertionError($message?:'The current version is lower than required "8.1"');}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81(){if(\PHP_VERSION_ID>=80100){return true;}return false;}
    }}