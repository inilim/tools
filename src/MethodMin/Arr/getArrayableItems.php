<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function getArrayableItems($items):array{if($items===null){return[];}elseif(\is_scalar($items)||\Inilim\Tool\Method\Check\php81()&&$items instanceof \UnitEnum){return \Inilim\Tool\Method\Arr\wrap($items);}return \Inilim\Tool\Method\Arr\from($items);}if(!\Inilim\Tool\Arr::__definedIfNot('from')){
    function from($items):array{$type=\gettype($items);if($type==='array'){return $items;}elseif($type==='object'){if(false){}elseif(\method_exists($items,'toArray')){return $items -> toArray();}elseif(\method_exists($items,'toJson')){return (array) \json_decode($items -> toJson(),true);}elseif(\Inilim\Tool\Method\Check\php80()&&$items instanceof \WeakMap){return \iterator_to_array($items,false);}elseif($items instanceof \JsonSerializable){return (array) $items -> jsonSerialize();}elseif($items instanceof \Traversable){return \iterator_to_array($items);}else{return (array) $items;}}throw new \InvalidArgumentException('Items cannot be represented by a scalar value.');}
    }if(!\Inilim\Tool\Arr::__definedIfNot('wrap')){
    function wrap($value):array{return \is_array($value)?$value:[$value];}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}