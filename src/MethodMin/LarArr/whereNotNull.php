<?php

namespace Inilim\Tool\Method\LarArr{function whereNotNull($array){return \Inilim\Tool\Method\LarArr\where($array,static fn($value)=>!\is_null($value));}if(!\Inilim\Tool\LarArr::__definedIfNot('where')){
    function where($array,callable $callback){return \array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);}
    }}