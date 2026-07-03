<?php

namespace Inilim\Tool\Method\Arr{function onlyNestedArray(array $array,$keys,int $depth=1):array{return \Inilim\Tool\Method\Arr\nestedMap($array,$depth,static function(array $value)use($keys){return \Inilim\Tool\Method\LarArr\only($value,$keys);});}if(!\Inilim\Tool\Arr::__definedIfNot('nestedMap')){
    function nestedMap(array $array,int $depth,callable $callable):array{$internal=static function(array&$array,$key,int $depth,callable $callable)use(&$internal):array{if($depth<=0){return $callable($array,$key);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=$internal($item,$idx,$depth-1,$callable);}}return $array;};$result=$internal($array,null,$depth,$callable);$internal=null;return $result;}
    }}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('only')){
    function only($array,$keys){return \array_intersect_key($array,\array_flip((array) $keys));}
    }}