<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function onlyNestedArray(array $array,$keys,int $depth=1){return \Inilim\Tool\Method\Arr\nestedMap($array,$depth,static function($value)use($keys){return \Inilim\Tool\Method\Arr\only($value,$keys);});}if(!\Inilim\Tool\Arr::__definedIfNot('nestedMap')){
    function nestedMap(array $array,int $depth,callable $callable){$internal=static function($internal,&$array,$key,$depth,$callable){/***@var\Closure$internal*@varmixed[]$array*@varint|string|null$key*@varint$depth*@varcallable$callable*/if($depth<=0){return $callable($array,$key);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=$internal($internal,$item,$idx,$depth-1,$callable);}}return $array;};return $internal -> __invoke($internal,$array,null,$depth,$callable);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('only')){
    function only(array $array,$keys):array{return \array_intersect_key($array,\array_flip((array) $keys));}
    }}