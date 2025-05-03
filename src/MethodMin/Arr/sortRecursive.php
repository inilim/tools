<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function sortRecursive(array $array,int $options=\SORT_REGULAR,bool $descending=true):array{foreach($array as&$value){if(\is_array($value)){$value=\Inilim\Tool\Method\Arr\sortRecursive($value,$options,$descending);}}if(\Inilim\Tool\Method\Arr\isAssoc($array)){$descending?\krsort($array,$options):\ksort($array,$options);}else{$descending?\rsort($array,$options):\sort($array,$options);}return $array;}if(!\Inilim\Tool\Arr::__definedIfNot('isAssoc')){
    function isAssoc(array $array):bool{$keys=\array_keys($array);return \array_keys($keys)!==$keys;}
    }}