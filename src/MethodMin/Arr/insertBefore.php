<?php

namespace Inilim\Tool\Method\Arr{function insertBefore(){if(\func_num_args()!==0){throw new \InvalidArgumentException(__FUNCTION__.'()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$key,array $inserted){$offset=$key===null?0:(int) \Inilim\Tool\Method\Arr\getKeyOffset($array,$key);$array=\array_slice($array,0,$offset,true)+$inserted+\array_slice($array,$offset,\sizeof($array),true);};}if(!\Inilim\Tool\Arr::__definedIfNot('getKeyOffset')){
    function getKeyOffset(array $array,$key){$value=\array_search(\key([$key=>null]),\array_keys($array),true);return $value===false?null:$value;}
    }}