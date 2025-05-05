<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function forget(){if(\func_num_args()!==0){throw new \InvalidArgumentException('forget()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$keys){$original=&$array;$keys=(array) $keys;if(!$keys){return;}foreach($keys as $key){$key=(string) $key;if(\Inilim\Tool\Method\Arr\exists($array,$key)){unset($array[$key]);continue;}$parts=\explode('.',$key);$array=&$original;while(\sizeof($parts)>1){$part=\array_shift($parts);if(isset($array[$part])&&\is_array($array[$part])){$array=&$array[$part];}else{continue 2;}}unset($array[\array_shift($parts)]);}};}if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }}