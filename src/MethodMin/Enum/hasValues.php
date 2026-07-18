<?php

namespace Inilim\Tool\Method\Enum{function hasValues($enum):bool{\Inilim\Tool\Method\Assert\php81();if(\is_object($enum)&&$enum instanceof \BackedEnum){return true;}return \Inilim\Tool\Method\Enum\head($enum)instanceof \BackedEnum;}if(!\Inilim\Tool\Enum::__definedIfNot('cases')){
    function cases($enum){\Inilim\Tool\Method\Assert\php81();if(\Inilim\Tool\Method\Other\isEnum($enum)){return $enum :: cases();}throw new \InvalidArgumentException('Must be of type \UnitEnum');}
    }if(!\Inilim\Tool\Enum::__definedIfNot('head')){
    function head($enum){return \Inilim\Tool\Method\Arr\head(\Inilim\Tool\Method\Enum\cases($enum));}
    }}namespace Inilim\Tool\Method\Arr{if(!\Inilim\Tool\Arr::__definedIfNot('head')){
    function head(iterable $array,?callable $callback=null,$default=null){if($callback===null){if(empty($array)){return \Inilim\Tool\Method\Lar\value($default);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Lar\value($default);}foreach($array as $key=>$value){if($callback($value,$key)){return $value;}}return \Inilim\Tool\Method\Lar\value($default);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('isEnum')){
    function isEnum($v):bool{if(\PHP_VERSION_ID<80100){return false;}$t=\gettype($v);if($t==='object'){return $v instanceof \UnitEnum;}elseif($t==='string'){return \enum_exists($v);}return false;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('php81')){
    function php81(string $message=''){if(!\Inilim\Tool\Method\Check\php81()){throw new \InvalidArgumentException($message?:'The current version is lower than required "8.1"');}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}namespace Inilim\Tool\Method\Lar{if(!\Inilim\Tool\Lar::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}