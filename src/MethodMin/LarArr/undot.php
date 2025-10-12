<?php

namespace Inilim\Tool\Method\LarArr{function undot($array){$results=[];$set=\Inilim\Tool\Method\LarArr\set();foreach($array as $key=>$value){$set($results,$key,$value);}return $results;}if(!\Inilim\Tool\LarArr::__definedIfNot('set')){
    function set():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(&$array,$key,$value){if(\is_null($key)){return $array=$value;}$keys=\explode('.',$key);foreach($keys as $i=>$key){if(\count($keys)===1){break;}unset($keys[$i]);if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}