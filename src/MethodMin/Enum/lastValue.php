<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum{function lastValue($enum){$case=\Inilim\Tool\Method\Enum\last($enum);return $case -> value ?? null;}if(!\Inilim\Tool\Enum::__definedIfNot('cases')){
    function cases($enum){\Inilim\Tool\Method\Assert\php81();if(\Inilim\Tool\Method\Other\isEnum($enum)){return $enum :: cases();}throw new \InvalidArgumentException('Must be of type \UnitEnum');}
    }if(!\Inilim\Tool\Enum::__definedIfNot('last')){
    function last($enum){return \Inilim\Tool\Method\Arr\last(\Inilim\Tool\Method\Enum\cases($enum));}
    }}namespace Inilim\Tool\Method\Arr{if(!\Inilim\Tool\Arr::__definedIfNot('head')){
    function head(iterable $array,?callable $callback=null,$default=null){if($callback===null){if(empty($array)){return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $key=>$value){if($callback($value,$key)){return $value;}}return \Inilim\Tool\Method\Arr\value($default);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('last')){
    function last(iterable $array,?callable $callback=null,$default=null){if($callback===null){return empty($array)?\Inilim\Tool\Method\Arr\value($default):\Inilim\Tool\Method\PF\array_last($array);}return \Inilim\Tool\Method\Arr\head(\array_reverse($array,true),$callback,$default);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('isEnum')){
    function isEnum($v):bool{if(\PHP_VERSION_ID<80100){return false;}if(\is_object($v)){return $v instanceof \UnitEnum;}elseif(\is_string($v)){return \enum_exists($v);}return false;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('php81')){
    function php81(string $message=''){if(\Inilim\Tool\Method\Check\php81()){return;}throw new \AssertionError($message?:'The current version is lower than required "8.1"');}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }if(!\Inilim\Tool\Check::__definedIfNot('php85')){
    function php85():bool{return \PHP_VERSION_ID>=80500?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_last')){
    function array_last(array $array){if(\Inilim\Tool\Method\Check\php85()){return \array_last($array);}return $array?\current(\array_slice($array,-1)):null;}
    }}