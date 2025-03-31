<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function select(array $array,$keys){$keys=\Inilim\Tool\Method\Arr\wrap($keys);return \Inilim\Tool\Method\Arr\map($array,static function($item)use($keys){$result=[];foreach($keys as $key){if($key===null){continue;}if(\Inilim\Tool\Method\Arr\accessible($item)&&\Inilim\Tool\Method\Arr\exists($item,$key)){$result[$key]=$item[$key];}elseif(\is_object($item)&&isset($item ->{$key})){$result[$key]=$item ->{$key};}}return $result;});}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value){return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('map')){
    function map(array $array,callable $callback):array{$keys=\array_keys($array);try{$items=\array_map($callback,$array,$keys);}catch(\ArgumentCountError $e){$items=\array_map($callback,$array);}return \array_combine($keys,$items);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('wrap')){
    function wrap($value):array{return \is_array($value)?$value:[$value];}
    }}