<?php

namespace Inilim\Tool\Method\Arr;

function set(){if(\func_num_args()!==0){throw new \InvalidArgumentException(__FUNCTION__.'()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,?string $key,$value){if($key===null){return $array=$value;}$keys=\explode('.',$key);foreach($keys as $i=>$key){if(\sizeof($keys)===1){break;}unset($keys[$i]);/*// If the key doesn't exist at this depth, we will just create an empty array*//*// to hold the next value, allowing us to create the arrays to hold final*//*// values at the correct depth. Then we'll keep digging into the array.*/if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}