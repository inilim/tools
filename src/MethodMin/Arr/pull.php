<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function pull(){if(\func_num_args()!==0){throw new \InvalidArgumentException('pull()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$key,$default=null){$value=\Inilim\Tool\Method\Arr\get($array,$key,$default);\Inilim\Tool\Method\Arr\forget()($array,$key);return $value;};}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('forget')){
    function forget(){if(\func_num_args()!==0){throw new \InvalidArgumentException('forget()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$keys){$original=&$array;$keys=(array) $keys;if(!$keys){return;}foreach($keys as $key){if(\Inilim\Tool\Method\Arr\exists($array,$key)){unset($array[$key]);continue;}$parts=\explode('.',$key);$array=&$original;while(\sizeof($parts)>1){$part=\array_shift($parts);if(isset($array[$part])&&\is_array($array[$part])){$array=&$array[$part];}else{continue 2;}}unset($array[\array_shift($parts)]);}};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('get')){
    function get($array,$key,$default=null){if(!\Inilim\Tool\Method\Arr\accessible($array)){return \Inilim\Tool\Method\Arr\value($default);}if($key===null){return $array;}if(\Inilim\Tool\Method\Arr\exists($array,$key)){return $array[$key];}if(\strpos(\strval($key),'.')===false){return $array[$key]?? \Inilim\Tool\Method\Arr\value($default);}foreach(\explode('.',\strval($key))as $segment){if(\Inilim\Tool\Method\Arr\accessible($array)&&\Inilim\Tool\Method\Arr\exists($array,$segment)){$array=$array[$segment];}else{return \Inilim\Tool\Method\Arr\value($default);}}return $array;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value){return $value instanceof \Closure?$value():$value;}
    }}