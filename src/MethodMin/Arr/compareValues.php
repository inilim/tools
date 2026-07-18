<?php

namespace Inilim\Tool\Method\Arr{function compareValues(array $a,array $b,array ... $arrays):bool{$arrays[]=$a;$arrays[]=$b;$arrays=\array_map(static fn($array)=>\md5(\serialize($array)),\Inilim\Tool\Method\LarArr\sortRecursive(\Inilim\Tool\Method\Arr\resetKeysRecursive($arrays)));return \sizeof(\Inilim\Tool\Method\Arr\unique($arrays))===1;}if(!\Inilim\Tool\Arr::__definedIfNot('resetKeysRecursive')){
    function resetKeysRecursive(array $array):array{$internal=static function(array $array)use(&$internal):array{$array=\array_values($array);foreach($array as $idx=>$value){$array[$idx]=\is_array($value)?$internal($value):$value;}return $array;};$array=$internal($array);$internal=null;return $array;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('unique')){
    function unique(array $array):array{return \array_keys(\array_flip($array));}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_is_list')){
    function array_is_list(array $array):bool{if(\Inilim\Tool\Method\Check\php81()){return \array_is_list($array);}if([]===$array||$array===\array_values($array)){return true;}$nextKey=-1;foreach($array as $k=>$v){if($k!==++$nextKey){return false;}}return true;}
    }}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('sortRecursive')){
    function sortRecursive($array,$options=\SORT_REGULAR,$descending=false){foreach($array as&$value){if(\is_array($value)){$value=\Inilim\Tool\Method\LarArr\sortRecursive($value,$options,$descending);}}if(!\Inilim\Tool\Method\PF\array_is_list($array)){$descending?\krsort($array,$options):\ksort($array,$options);}else{$descending?\rsort($array,$options):\sort($array,$options);}return $array;}
    }}