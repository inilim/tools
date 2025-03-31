<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function insertAfter(){if(\func_num_args()!==0){throw new \InvalidArgumentException(__FUNCTION__.'()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$key,array $inserted){if($key===null||($offset=\Inilim\Tool\Method\Arr\getKeyOffset($array,$key))===null){$offset=\sizeof($array)-1;}$array=\array_slice($array,0,$offset+1,true)+$inserted+\array_slice($array,$offset+1,\sizeof($array),true);};}if(!\Inilim\Tool\Arr::__definedIfNot('getKeyOffset')){
    function getKeyOffset(array $array,$key){$value=\array_search(\key([$key=>null]),\array_keys($array),true);return $value===false?null:$value;}
    }}