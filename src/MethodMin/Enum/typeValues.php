<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum{function typeValues($enum){$case=\Inilim\Tool\Method\Enum\firstValue($enum);$type=\Inilim\Tool\Method\Other\getType($case);if($type==='null'){return null;}return $type;}if(!\Inilim\Tool\Enum::__definedIfNot('cases')){
    function cases($enum){\Inilim\Tool\Method\Assert\php81();if(\Inilim\Tool\Method\Other\isEnum($enum)){return $enum :: cases();}throw new \InvalidArgumentException('Must be of type \UnitEnum');}
    }if(!\Inilim\Tool\Enum::__definedIfNot('firstValue')){
    function firstValue($enum){$case=\Inilim\Tool\Method\Enum\head($enum);return $case -> value ?? null;}
    }if(!\Inilim\Tool\Enum::__definedIfNot('head')){
    function head($enum){return \Inilim\Tool\Method\Arr\head(\Inilim\Tool\Method\Enum\cases($enum));}
    }}namespace Inilim\Tool\Method\Arr{if(!\Inilim\Tool\Arr::__definedIfNot('head')){
    function head(iterable $array,?callable $callback=null,$default=null){if($callback===null){if(empty($array)){return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $key=>$value){if($callback($value,$key)){return $value;}}return \Inilim\Tool\Method\Arr\value($default);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value){return $value instanceof \Closure?$value():$value;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v){$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}elseif($v instanceof \Throwable){return 'object exception';}return 'object';case 'boolean':return 'bool';case 'integer':return 'int';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('isEnum')){
    function isEnum($v){if(\PHP_VERSION_ID<80100){return false;}if(\is_object($v)){return $v instanceof \UnitEnum;}elseif(\is_string($v)){return \enum_exists($v);}return false;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('php81')){
    function php81(string $message=''){if(\Inilim\Tool\Method\Check\php81()){return;}throw new \AssertionError($message?:'The current version is lower than required "8.1"');}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81(){return \PHP_VERSION_ID>=80100?true:false;}
    }}