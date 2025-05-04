<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function containsOneItem(array $array,?callable $callable=null):bool{if($callable){return \sizeof(\Inilim\Tool\Method\Arr\where($array,$callable))===1;}return \sizeof($array)===1;}if(!\Inilim\Tool\Arr::__definedIfNot('where')){
    function where(array $array,callable $callback,bool $preserveKeys=true):array{$result=\array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);return $preserveKeys?$result:\array_values($result);}
    }}