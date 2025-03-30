<?php

namespace Inilim\Tool\Method\Arr{function setValueIfNotExists(){if(\func_num_args()!==0){throw new \InvalidArgumentException(__FUNCTION__.'()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,string $key,$value){if(!\Inilim\Tool\Method\Arr\has($array,$key)){\Inilim\Tool\Method\Arr\set()($array,$key,$value);return true;}return false;};}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value){return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('has')){
    function has($array,$keys){$keys=(array) $keys;if(!$array||$keys===[]){return false;}foreach($keys as $key){$subKeyArray=$array;if(\Inilim\Tool\Method\Arr\exists($array,$key)){continue;}foreach(\explode('.',$key)as $segment){if(\Inilim\Tool\Method\Arr\accessible($subKeyArray)&&\Inilim\Tool\Method\Arr\exists($subKeyArray,$segment)){$subKeyArray=$subKeyArray[$segment];}else{return false;}}}return true;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('set')){
    function set(){if(\func_num_args()!==0){throw new \InvalidArgumentException(__FUNCTION__.'()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,?string $key,$value){if($key===null){return $array=$value;}$keys=\explode('.',$key);foreach($keys as $i=>$key){if(\sizeof($keys)===1){break;}unset($keys[$i]);/*// If the key doesn't exist at this depth, we will just create an empty array*//*// to hold the next value, allowing us to create the arrays to hold final*//*// values at the correct depth. Then we'll keep digging into the array.*/if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }}