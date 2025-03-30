<?php

namespace Inilim\Tool\Method\Arr{function exceptNestedArray(array $array,$keys,int $depth=1){if($depth<=0){return \Inilim\Tool\Method\Arr\except($array,$keys);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=\Inilim\Tool\Method\Arr\exceptNestedArray($item,$keys,$depth-1);}}return $array;}if(!\Inilim\Tool\Arr::__definedIfNot('except')){
    function except(array $array,$keys){\Inilim\Tool\Method\Arr\forget()($array,$keys);return $array;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('forget')){
    function forget(){if(\func_num_args()!==0){throw new \InvalidArgumentException(__FUNCTION__.'()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$keys){$original=&$array;$keys=(array) $keys;if(!$keys){return;}foreach($keys as $key){/*// if the exact key exists in the top-level, remove it*/if(\Inilim\Tool\Method\Arr\exists($array,$key)){unset($array[$key]);continue;}$parts=\explode('.',$key);/*// clean up before each pass*/$array=&$original;while(\sizeof($parts)>1){$part=\array_shift($parts);if(isset($array[$part])&&\is_array($array[$part])){$array=&$array[$part];}else{continue 2;}}unset($array[\array_shift($parts)]);}};}
    }}