<?php

namespace Inilim\Tool\Method\LarArr{function reject($array,callable $callback){return \Inilim\Tool\Method\LarArr\where($array,static fn($value,$key)=>!$callback($value,$key));}if(!\Inilim\Tool\LarArr::__definedIfNot('where')){
    function where($array,callable $callback){return \array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);}
    }}