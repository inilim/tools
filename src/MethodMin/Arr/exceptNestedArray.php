<?php

namespace Inilim\Tool\Method\Arr{function exceptNestedArray(array $array,$keys,int $depth=1){if($depth<=0){return \Inilim\Tool\Method\Arr\except($array,$keys);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=\Inilim\Tool\Method\Arr\exceptNestedArray($item,$keys,$depth-1);}}return $array;}if(!\Inilim\Tool\Arr::__definedIfNot('except')){
    function except(array $array,$keys){\Inilim\Tool\Arr :: forget($array,$keys);return $array;}
    }}