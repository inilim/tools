<?php

namespace Inilim\Tool\Method\Arr{function select(array $array,$keys){$keys=\Inilim\Tool\Method\LarArr\wrap($keys);return \Inilim\Tool\Method\Arr\map($array,static function($item)use($keys){$result=[];foreach($keys as $key){if($key===null){continue;}if(\Inilim\Tool\Method\Arr\accessible($item)&&\Inilim\Tool\Method\Arr\exists($item,$key)){$result[$key]=$item[$key];}elseif(\is_object($item)&&isset($item ->{$key})){$result[$key]=$item ->{$key};}}return $result;});}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('map')){
    function map(array $array,callable $callback):array{$keys=\array_keys($array);try{$items=\array_map($callback,$array,$keys);}catch(\ArgumentCountError $e){$items=\array_map($callback,$array);}return \array_combine($keys,$items);}
    }}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('wrap')){
    function wrap($value){if(\is_null($value)){return[];}return \is_array($value)?$value:[$value];}
    }}