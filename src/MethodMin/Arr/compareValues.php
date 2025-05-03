<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function compareValues(array $a,array $b,array ... $arrays):bool{$arrays[]=$a;$arrays[]=$b;$arrays=\array_map(static fn($array)=>\md5(\serialize($array)),\Inilim\Tool\Method\Arr\sortRecursive(\Inilim\Tool\Method\Arr\resetKeysRecursive($arrays)));return \sizeof(\Inilim\Tool\Method\Arr\unique($arrays))===1;}if(!\Inilim\Tool\Arr::__definedIfNot('isAssoc')){
    function isAssoc(array $array):bool{$keys=\array_keys($array);return \array_keys($keys)!==$keys;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('resetKeysRecursive')){
    function resetKeysRecursive(array $array){$array=\array_values($array);foreach($array as $idx=>$value){$array[$idx]=\is_array($value)?\Inilim\Tool\Method\Arr\resetKeysRecursive($value):$value;}return $array;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('sortRecursive')){
    function sortRecursive(array $array,int $options=\SORT_REGULAR,bool $descending=true):array{foreach($array as&$value){if(\is_array($value)){$value=\Inilim\Tool\Method\Arr\sortRecursive($value,$options,$descending);}}if(\Inilim\Tool\Method\Arr\isAssoc($array)){$descending?\krsort($array,$options):\ksort($array,$options);}else{$descending?\rsort($array,$options):\sort($array,$options);}return $array;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('unique')){
    function unique(array $array):array{return \array_keys(\array_flip($array));}
    }}