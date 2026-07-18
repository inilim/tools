<?php

namespace Inilim\Tool\Method\Arr{function reject(array $array,callable $callback):array{return \Inilim\Tool\Method\LarArr\where($array,static fn($value,$key)=>!$callback($value,$key));}}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('where')){
    function where($array,callable $callback){return \array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);}
    }}