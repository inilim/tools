<?php

namespace Inilim\Tool\Method\Arr{function sortRecursive(array $array,int $options=\SORT_REGULAR,bool $descending=false):array{foreach($array as&$value){if(\is_array($value)){$value=\Inilim\Tool\Method\LarArr\sortRecursive($value,$options,$descending);}}if(\Inilim\Tool\Method\LarArr\isAssoc($array)){$descending?\krsort($array,$options):\ksort($array,$options);}else{$descending?\rsort($array,$options):\sort($array,$options);}return $array;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_is_list')){
    function array_is_list(array $array):bool{if(\Inilim\Tool\Method\Check\php81()){return \array_is_list($array);}if([]===$array||$array===\array_values($array)){return true;}$nextKey=-1;foreach($array as $k=>$v){if($k!==++$nextKey){return false;}}return true;}
    }}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('isAssoc')){
    function isAssoc(array $array){return!\Inilim\Tool\Method\PF\array_is_list($array);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('sortRecursive')){
    function sortRecursive($array,$options=\SORT_REGULAR,$descending=false){foreach($array as&$value){if(\is_array($value)){$value=\Inilim\Tool\Method\LarArr\sortRecursive($value,$options,$descending);}}if(!\Inilim\Tool\Method\PF\array_is_list($array)){$descending?\krsort($array,$options):\ksort($array,$options);}else{$descending?\rsort($array,$options):\sort($array,$options);}return $array;}
    }}