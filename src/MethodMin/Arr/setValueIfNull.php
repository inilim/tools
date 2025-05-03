<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function setValueIfNull(){if(\func_num_args()!==0){throw new \InvalidArgumentException('setValueIfNull()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$key,$value){if(\Inilim\Tool\Method\Arr\has($array,$key)&&\Inilim\Tool\Method\Arr\get($array,$key)===null){\Inilim\Tool\Method\Arr\set()($array,$key,$value);return true;}return false;};}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('get')){
    function get($array,$key,$default=null){if(!\Inilim\Tool\Method\Arr\accessible($array)){return \Inilim\Tool\Method\Arr\value($default);}if($key===null){return $array;}if(\Inilim\Tool\Method\Arr\exists($array,$key)){return $array[$key];}if(\strpos(\strval($key),'.')===false){return $array[$key]?? \Inilim\Tool\Method\Arr\value($default);}foreach(\explode('.',\strval($key))as $segment){if(\Inilim\Tool\Method\Arr\accessible($array)&&\Inilim\Tool\Method\Arr\exists($array,$segment)){$array=$array[$segment];}else{return \Inilim\Tool\Method\Arr\value($default);}}return $array;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('has')){
    function has($array,$keys):bool{$keys=(array) $keys;if(!$array||$keys===[]){return false;}foreach($keys as $key){$subKeyArray=$array;if(\Inilim\Tool\Method\Arr\exists($array,$key)){continue;}foreach(\explode('.',$key)as $segment){if(\Inilim\Tool\Method\Arr\accessible($subKeyArray)&&\Inilim\Tool\Method\Arr\exists($subKeyArray,$segment)){$subKeyArray=$subKeyArray[$segment];}else{return false;}}}return true;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('set')){
    function set(){if(\func_num_args()!==0){throw new \InvalidArgumentException('set()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,?string $key,$value){if($key===null){return $array=$value;}$keys=\explode('.',$key);foreach($keys as $i=>$key){if(\sizeof($keys)===1){break;}unset($keys[$i]);if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value){return $value instanceof \Closure?$value():$value;}
    }}