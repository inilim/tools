<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function undot($array):array{$results=[];$set=\Inilim\Tool\Method\Arr\set();foreach($array as $key=>$value){$set($results,$key,$value);}return $results;}if(!\Inilim\Tool\Arr::__definedIfNot('set')){
    function set(){if(\func_num_args()!==0){throw new \InvalidArgumentException('set()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$key,$value){if($key===null){return $array=$value;}$keys=\explode('.',(string) $key);foreach($keys as $i=>$key){if(\sizeof($keys)===1){break;}unset($keys[$i]);if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }}