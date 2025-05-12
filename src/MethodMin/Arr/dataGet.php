<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function dataGet($target,$key,$default=null){if($key===null){return $target;}$key=\is_array($key)?$key:\explode('.',$key);foreach($key as $i=>$segment){unset($key[$i]);if($segment===null){return $target;}if($segment==='*'){if(\is_object($target)){$target=\Inilim\Tool\Method\Arr\from($target);}elseif(!\is_iterable($target)){return \Inilim\Tool\Method\Arr\value($default);}$result=[];foreach($target as $item){$result[]=\Inilim\Tool\Method\Arr\dataGet($item,$key);}return \in_array('*',$key)?\Inilim\Tool\Method\Arr\collapse($result):$result;}if($segment==='\*'){$segment='*';}elseif($segment==='\{first}'){$segment='{first}';}elseif($segment==='{first}'){$segment=\array_key_first(\is_array($target)?$target:\Inilim\Tool\Method\Arr\from($target));}elseif($segment==='\{last}'){$segment='{last}';}elseif($segment==='{last}'){$segment=\array_key_last(\is_array($target)?$target:\Inilim\Tool\Method\Arr\from($target));}if(\Inilim\Tool\Method\Arr\accessible($target)&&\Inilim\Tool\Method\Arr\exists($target,$segment)){$target=$target[$segment];}elseif(\is_object($target)&&isset($target ->{$segment})){$target=$target ->{$segment};}else{return \Inilim\Tool\Method\Arr\value($default);}}return $target;}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('collapse')){
    function collapse(iterable $array):array{$results=[];foreach($array as $values){if($values instanceof \Traversable){$values=\iterator_to_array($values);}elseif(!\is_array($values)){continue;}$results[]=$values;}return \array_merge([],... $results);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('from')){
    function from($items):array{$type=\gettype($items);if($type==='array'){return $items;}elseif($type==='object'){if($items instanceof \Traversable){return \iterator_to_array($items);}elseif($items instanceof \JsonSerializable){return (array) $items -> jsonSerialize();}elseif(\Inilim\Tool\Method\Check\php80()&&$items instanceof \WeakMap){return \iterator_to_array($items,false);}elseif(\method_exists($items,'toArray')){return $items -> toArray();}elseif(\method_exists($items,'toJson')){return (array) \json_decode($items -> toJson(),true);}else{return (array) $items;}}throw new \InvalidArgumentException('Items cannot be represented by a scalar value.');}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}