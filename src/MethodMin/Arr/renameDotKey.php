<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function renameDotKey():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(array&$array,string $oldKey,string $newKey):bool{$tArr=\Inilim\Tool\Method\Arr\dot($array);$result=\Inilim\Tool\Method\Arr\renameKey()($tArr,$oldKey,$newKey);$array=\Inilim\Tool\Method\Arr\undot($tArr);return $result;};}if(!\Inilim\Tool\Arr::__definedIfNot('dot')){
    function dot(iterable $array,string $prepend='',string $separator='.'):array{$results=[];$flatten=static function(iterable $data,string $prefix,string $separator)use(&$results,&$flatten){foreach($data as $key=>$value){$newKey=$prefix.$key;if(\is_array($value)&&!empty($value)){$flatten($value,$newKey.$separator,$separator);}else{$results[$newKey]=$value;}}};$flatten($array,$prepend,$separator);$flatten=null;return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('getKeyOffset')){
    function getKeyOffset(array $array,$key){$value=\array_search(\key([$key=>null]),\array_keys($array),true);return $value===false?null:$value;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('renameKey')){
    function renameKey():\CLosure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(array&$array,$oldKey,$newKey){$offset=\Inilim\Tool\Method\Arr\getKeyOffset($array,$oldKey);if($offset===null){return false;}$val=&$array[$oldKey];$keys=\array_keys($array);$keys[$offset]=$newKey;$array=\array_combine($keys,$array);$array[$newKey]=&$val;return true;};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('set')){
    function set():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(array&$array,$key,$value):array{if($key===null){return $array=$value;}$keys=\explode('.',(string) $key);foreach($keys as $i=>$key){if(\sizeof($keys)===1){break;}unset($keys[$i]);if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('undot')){
    function undot($array):array{$results=[];$set=\Inilim\Tool\Method\Arr\set();foreach($array as $key=>$value){$set($results,$key,$value);}return $results;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}