<?php

namespace Inilim\Tool\Method\Arr{function renameDotKey(){return static function(array&$array,string $oldKey,string $newKey){$tArr=\Inilim\Tool\Method\Arr\dot($array);$result=\Inilim\Tool\Method\Arr\renameKey()($tArr,$oldKey,$newKey);$array=\Inilim\Tool\Method\Arr\undot($tArr);return $result;};}if(!\Inilim\Tool\Arr::__definedIfNot('dot')){
    function dot(iterable $array,string $prepend=''){$results=[];foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$results=\array_merge($results,\Inilim\Tool\Method\Arr\dot($value,$prepend.$key.'.'));}else{$results[$prepend.$key]=$value;}}return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('getKeyOffset')){
    function getKeyOffset(array $array,$key){$value=\array_search(\key([$key=>null]),\array_keys($array),true);return $value===false?null:$value;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('renameKey')){
    function renameKey(){return static function(array&$array,$oldKey,$newKey){$offset=\Inilim\Tool\Method\Arr\getKeyOffset($array,$oldKey);if($offset===null){return false;}$val=&$array[$oldKey];$keys=\array_keys($array);$keys[$offset]=$newKey;$array=\array_combine($keys,$array);$array[$newKey]=&$val;return true;};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('set')){
    function set(){return static function(array&$array,?string $key,$value){if($key===null){return $array=$value;}$keys=\explode('.',$key);foreach($keys as $i=>$key){if(\sizeof($keys)===1){break;}unset($keys[$i]);/*// If the key doesn't exist at this depth, we will just create an empty array*//*// to hold the next value, allowing us to create the arrays to hold final*//*// values at the correct depth. Then we'll keep digging into the array.*/if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('undot')){
    function undot($array):array{$results=[];foreach($array as $key=>$value){\Inilim\Tool\Method\Arr\set()($results,$key,$value);}return $results;}
    }}