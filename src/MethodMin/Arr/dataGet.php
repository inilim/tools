<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function dataGet($target,$key,$default=null){if($key===null){return $target;}$key=\is_array($key)?$key:\explode('.',$key);foreach($key as $i=>$segment){unset($key[$i]);if($segment===null){return $target;}if($segment==='*'){if(\is_object($target)){$target=\Inilim\Tool\Method\Arr\getArrayableItems($target);}elseif(!\is_iterable($target)){return \Inilim\Tool\Method\Arr\value($default);}$result=[];foreach($target as $item){$result[]=\Inilim\Tool\Method\Arr\dataGet($item,$key);}return \in_array('*',$key)?\Inilim\Tool\Method\Arr\collapse($result):$result;}switch($segment){case '\*':$segment='*';break;case '\{first}':$segment='{first}';break;case '{first}':$segment=\array_key_first(\is_array($target)?$target:\Inilim\Tool\Method\Arr\getArrayableItems($target));break;case '\{last}':$segment='{last}';break;case '{last}':$segment=\array_key_last(\is_array($target)?$target:\Inilim\Tool\Method\Arr\getArrayableItems($target));break;}if(\Inilim\Tool\Method\Arr\accessible($target)&&\Inilim\Tool\Method\Arr\exists($target,$segment)){$target=$target[$segment];}elseif(\is_object($target)&&isset($target ->{$segment})){$target=$target ->{$segment};}else{return \Inilim\Tool\Method\Arr\value($default);}}return $target;}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('collapse')){
    function collapse(iterable $array){$results=[];foreach($array as $values){if(!\is_array($values)){continue;}$results[]=$values;}return \array_merge([],... $results);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('getArrayableItems')){
    function getArrayableItems($items){$type=\gettype($items);if($type==='array'){return $items;}elseif($type==='object'){switch(true){case \PHP_VERSION_ID>=80000&&$items instanceof \WeakMap:throw new \InvalidArgumentException('Collections can not be created using instances of WeakMap.');case $items instanceof \Traversable:return \iterator_to_array($items);case $items instanceof \JsonSerializable:return (array) $items -> jsonSerialize();case \PHP_VERSION_ID>=80100&&$items instanceof \UnitEnum:return[$items];case \method_exists($items,'toArray'):return (array) $items -> toArray();case \method_exists($items,'toJson'):return (array) \json_decode($items -> toJson(),true);}}return (array) $items;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value){return $value instanceof \Closure?$value():$value;}
    }}