<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum{function is(object $enum,object $needle){\Inilim\Tool\Method\Assert\enumCase($needle);return \Inilim\Tool\Method\Enum\in($enum,[$needle]);}if(!\Inilim\Tool\Enum::__definedIfNot('in')){
    function in(object $enum,array $haystack){\Inilim\Tool\Method\Assert\enumCase($enum);foreach($haystack as $item){if($enum===$item){return true;}}return false;}
    }if(!\Inilim\Tool\Enum::__definedIfNot('isCase')){
    function isCase($v){if(\PHP_VERSION_ID<80100){return false;}return $v instanceof \UnitEnum;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('enumCase')){
    function enumCase($value,string $message=''){if(\Inilim\Tool\Method\Enum\isCase($value)){return;}throw new \AssertionError($message?:'Expected an \UnitEnum');}
    }}