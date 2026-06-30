<?php

namespace Inilim\Tool\Method\LarArr{function select($array,$keys){$keys=\Inilim\Tool\Method\LarArr\wrap($keys);return \Inilim\Tool\Method\LarArr\map($array,static function($item)use($keys){$result=[];foreach($keys as $key){if(\Inilim\Tool\Method\LarArr\accessible($item)&&\Inilim\Tool\Method\LarArr\exists($item,$key)){$result[$key]=$item[$key];}elseif(\is_object($item)&&isset($item ->{$key})){$result[$key]=$item ->{$key};}}return $result;});}if(!\Inilim\Tool\LarArr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}if(\is_float($key)||\is_null($key)){$key=(string) $key;}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('map')){
    function map(array $array,callable $callback){$keys=\array_keys($array);try{$items=\array_map($callback,$array,$keys);}catch(\ArgumentCountError $e){$items=\array_map($callback,$array);}return \array_combine($keys,$items);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('wrap')){
    function wrap($value){if(\is_null($value)){return[];}return \is_array($value)?$value:[$value];}
    }}