<?php

namespace Inilim\Tool\Method\Arr{function containsOneItem(array $array,?callable $callable=null):bool{if($callable){return \sizeof(\Inilim\Tool\Method\LarArr\where($array,$callable))===1;}return \sizeof($array)===1;}}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('where')){
    function where($array,callable $callback){return \array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);}
    }}