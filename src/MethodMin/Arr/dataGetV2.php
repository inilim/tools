<?php

namespace Inilim\Tool\Method\Arr{function dataGetV2($target,$key,$default=null){if($key===null){return $target;}if(\is_array($key)||\is_int($key)||!\Inilim\Tool\Method\Str\contains($key,'*')){return \Inilim\Tool\Method\Arr\dataGet($target,$key,$default);}$keys=\Inilim\Tool\Method\Arr\dotKeysByPattern($target,$key);if(!$keys){return $default;}return \Inilim\Tool\Method\Arr\dataGet(\Inilim\Tool\Method\Arr\undot(\Inilim\Tool\Method\Arr\only(\Inilim\Tool\Method\Arr\dot($target),$keys)),$key,$default);}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value){return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('collapse')){
    function collapse(iterable $array){$results=[];foreach($array as $values){if(!\is_array($values)){continue;}$results[]=$values;}return \array_merge([],... $results);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dataGet')){
    function dataGet($target,$key,$default=null){if($key===null){return $target;}$key=\is_array($key)?$key:\explode('.',$key);foreach($key as $i=>$segment){unset($key[$i]);if($segment===null){return $target;}if($segment==='*'){if(!\is_array($target)){return $default;}$result=[];foreach($target as $item){$result[]=\Inilim\Tool\Method\Arr\dataGet($item,$key);}return \in_array('*',$key)?\Inilim\Tool\Method\Arr\collapse($result):$result;}if(\Inilim\Tool\Method\Arr\accessible($target)&&\Inilim\Tool\Method\Arr\exists($target,$segment)){$target=$target[$segment];}elseif(\is_object($target)&&isset($target ->{$segment})){$target=$target ->{$segment};}else{return $default;}}return $target;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dot')){
    function dot(iterable $array,string $prepend=''){$results=[];foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$results=\array_merge($results,\Inilim\Tool\Method\Arr\dot($value,$prepend.$key.'.'));}else{$results[$prepend.$key]=$value;}}return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dotKeys')){
    function dotKeys(iterable $array,string $prepend=''){$results=[];foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$results=\array_merge($results,\Inilim\Tool\Method\Arr\dotKeys($value,$prepend.$key.'.'));}else{$results[]=$prepend.$key;}}return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dotKeysByPattern')){
    function dotKeysByPattern(iterable $target,string $dotPattern){$regex='#^'.\str_replace('\*','[^\.]+',\preg_quote($dotPattern)).'#';return \array_values(\array_filter(\Inilim\Tool\Method\Arr\dotKeys($target),static fn($key)=>\preg_match($regex,$key)));}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('only')){
    function only(array $array,$keys):array{return \array_intersect_key($array,\array_flip((array) $keys));}
    }if(!\Inilim\Tool\Arr::__definedIfNot('set')){
    function set(){if(\func_num_args()!==0){throw new \InvalidArgumentException(__FUNCTION__.'()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,?string $key,$value){if($key===null){return $array=$value;}$keys=\explode('.',$key);foreach($keys as $i=>$key){if(\sizeof($keys)===1){break;}unset($keys[$i]);/*// If the key doesn't exist at this depth, we will just create an empty array*//*// to hold the next value, allowing us to create the arrays to hold final*//*// values at the correct depth. Then we'll keep digging into the array.*/if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('undot')){
    function undot($array):array{$results=[];$set=\Inilim\Tool\Method\Arr\set();foreach($array as $key=>$value){$set($results,$key,$value);}return $results;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('_contains')){
    function _contains(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_contains($haystack,$needle);}return ''===$needle||false!==strpos($haystack,$needle);}
    }if(!\Inilim\Tool\Str::__definedIfNot('contains')){
    function contains(string $haystack,$needles,bool $ignoreCase=false){if($ignoreCase){$haystack=\mb_strtolower($haystack,'UTF-8');}if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($ignoreCase){$needle=\mb_strtolower($needle,'UTF-8');}if($needle!==''&&\Inilim\Tool\Method\Str\_contains($haystack,$needle)){return true;}}return false;}
    }}