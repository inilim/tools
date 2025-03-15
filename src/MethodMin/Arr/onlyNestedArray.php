<?php

namespace Inilim\Tool\Method\Arr{function onlyNestedArray(array $array,$keys,int $depth=1):array{if($depth<1){return \Inilim\Tool\Method\Arr\only($array,$keys);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=\Inilim\Tool\Method\Arr\onlyNestedArray($item,$keys,$depth-1);}}return $array;}if(!\Inilim\Tool\Arr::__definedIfNot('only')){
    function only(array $array,$keys):array{return \array_intersect_key($array,\array_flip((array) $keys));}
    }}