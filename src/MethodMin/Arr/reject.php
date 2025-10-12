<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function reject(array $array,callable $callback):array{return \Inilim\Tool\Method\Arr\where($array,static fn($value,$key)=>!$callback($value,$key));}if(!\Inilim\Tool\Arr::__definedIfNot('where')){
    function where(array $array,callable $callback,bool $preserveKeys=true):array{$result=\array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);return $preserveKeys?$result:\array_values($result);}
    }}