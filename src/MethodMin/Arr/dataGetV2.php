<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function dataGetV2($target,$key,$default=null){if($key===null){return $target;}if(\is_array($key)||\is_int($key)||!\Inilim\Tool\Method\Str\contains($key,'*')){return \Inilim\Tool\Method\Arr\dataGet($target,$key,$default);}$keys=\Inilim\Tool\Method\Arr\dotKeysByPattern($target,$key);if(!$keys){return \Inilim\Tool\Method\Arr\value($default);}return \Inilim\Tool\Method\Arr\dataGet(\Inilim\Tool\Method\Arr\undot(\Inilim\Tool\Method\Arr\only(\Inilim\Tool\Method\Arr\dot($target),$keys)),$key,$default);}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('collapse')){
    function collapse(iterable $array):array{$results=[];foreach($array as $values){if($values instanceof \Traversable){$values=\iterator_to_array($values);}elseif(!\is_array($values)){continue;}$results[]=$values;}return \array_merge([],... $results);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dataGet')){
    function dataGet($target,$key,$default=null){if($key===null){return $target;}$key=\is_array($key)?$key:\explode('.',$key);foreach($key as $i=>$segment){unset($key[$i]);if($segment===null){return $target;}if($segment==='*'){if(\is_object($target)){$target=\Inilim\Tool\Method\Arr\getArrayableItems($target);}elseif(!\is_iterable($target)){return \Inilim\Tool\Method\Arr\value($default);}$result=[];foreach($target as $item){$result[]=\Inilim\Tool\Method\Arr\dataGet($item,$key);}return \in_array('*',$key)?\Inilim\Tool\Method\Arr\collapse($result):$result;}if($segment==='\*'){$segment='*';}elseif($segment==='\{first}'){$segment='{first}';}elseif($segment==='{first}'){$segment=\array_key_first(\is_array($target)?$target:\Inilim\Tool\Method\Arr\getArrayableItems($target));}elseif($segment==='\{last}'){$segment='{last}';}elseif($segment==='{last}'){$segment=\array_key_last(\is_array($target)?$target:\Inilim\Tool\Method\Arr\getArrayableItems($target));}if(\Inilim\Tool\Method\Arr\accessible($target)&&\Inilim\Tool\Method\Arr\exists($target,$segment)){$target=$target[$segment];}elseif(\is_object($target)&&isset($target ->{$segment})){$target=$target ->{$segment};}else{return \Inilim\Tool\Method\Arr\value($default);}}return $target;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dot')){
    function dot(iterable $array,string $prepend=''){$results=[];$flatten=static function($data,$prefix)use(&$results,&$flatten){foreach($data as $key=>$value){$newKey=$prefix.$key;if(\is_array($value)&&!empty($value)){$flatten($value,$newKey.'.');}else{$results[$newKey]=$value;}}};$flatten($array,$prepend);return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dotKeys')){
    function dotKeys(iterable $array,string $prepend=''){$results=[];foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$results=\array_merge($results,\Inilim\Tool\Method\Arr\dotKeys($value,$prepend.$key.'.'));}else{$results[]=$prepend.$key;}}return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dotKeysByPattern')){
    function dotKeysByPattern(iterable $target,string $dotPattern){$regex='#^'.\str_replace('\*','[^\.]+',\preg_quote($dotPattern)).'#';return \array_values(\array_filter(\Inilim\Tool\Method\Arr\dotKeys($target),static fn($key)=>\preg_match($regex,$key)));}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('getArrayableItems')){
    function getArrayableItems($items){$type=\gettype($items);if($type==='array'){return $items;}elseif($type==='object'){switch(true){case \PHP_VERSION_ID>=80000&&$items instanceof \WeakMap:throw new \InvalidArgumentException('Collections can not be created using instances of WeakMap.');case $items instanceof \Traversable:return \iterator_to_array($items);case $items instanceof \JsonSerializable:return (array) $items -> jsonSerialize();case \PHP_VERSION_ID>=80100&&$items instanceof \UnitEnum:return[$items];case \method_exists($items,'toArray'):return (array) $items -> toArray();case \method_exists($items,'toJson'):return (array) \json_decode($items -> toJson(),true);}}return (array) $items;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('only')){
    function only(array $array,$keys):array{return \array_intersect_key($array,\array_flip((array) $keys));}
    }if(!\Inilim\Tool\Arr::__definedIfNot('set')){
    function set(){if(\func_num_args()!==0){throw new \InvalidArgumentException('set()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$key,$value){if($key===null){return $array=$value;}$keys=\explode('.',(string) $key);foreach($keys as $i=>$key){if(\sizeof($keys)===1){break;}unset($keys[$i]);if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('undot')){
    function undot($array):array{$results=[];$set=\Inilim\Tool\Method\Arr\set();foreach($array as $key=>$value){$set($results,$key,$value);}return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('contains')){
    function contains(string $haystack,$needles,bool $ignoreCase=false):bool{if($ignoreCase){$haystack=\mb_strtolower($haystack,'UTF-8');}if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($ignoreCase){$needle=\mb_strtolower($needle,'UTF-8');}if($needle!==''&&\Inilim\Tool\Method\PF\str_contains($haystack,$needle)){return true;}}return false;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}