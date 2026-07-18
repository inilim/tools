<?php

namespace Inilim\Tool\Method\Arr{function setValueIfNotExists():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(array&$array,string $key,$value):bool{if(!\Inilim\Tool\Method\LarArr\has($array,$key)){\Inilim\Tool\Method\LarArr\set()($array,$key,$value);return true;}return false;};}}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}if(\is_float($key)||\is_null($key)){$key=(string) $key;}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('has')){
    function has($array,$keys){$keys=(array) $keys;if(!$array||$keys===[]){return false;}foreach($keys as $key){$subKeyArray=$array;if(\Inilim\Tool\Method\LarArr\exists($array,$key)){continue;}foreach(\explode('.',$key)as $segment){if(\Inilim\Tool\Method\LarArr\accessible($subKeyArray)&&\Inilim\Tool\Method\LarArr\exists($subKeyArray,$segment)){$subKeyArray=$subKeyArray[$segment];}else{return false;}}}return true;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('set')){
    function set():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(&$array,$key,$value){if(\is_null($key)){return $array=$value;}$keys=\explode('.',$key);foreach($keys as $i=>$key){if(\count($keys)===1){break;}unset($keys[$i]);if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }}