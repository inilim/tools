<?php

namespace Inilim\Tool\Method\Arr{function dataGetV2($target,$key,$default=null){if($key===null){return $target;}if(\is_array($key)||\is_int($key)||!\Inilim\Tool\Method\String\contains($key,'*')){return \Inilim\Tool\Method\Arr\dataGet($target,$key,$default);}$keys=\Inilim\Tool\Method\Arr\dotKeysByPattern($target,$key);if(!$keys){return $default;}return \Inilim\Tool\Method\Arr\dataGet(\Inilim\Tool\Arr :: undot(\Inilim\Tool\Method\Arr\only(\Inilim\Tool\Arr :: dot($target),$keys)),$key,$default);}if(!\Inilim\Tool\Arr::__definedIfNot('collapse')){
    function collapse(iterable $array){$results=[];foreach($array as $values){if(!\is_array($values)){continue;}$results[]=$values;}return \array_merge([],... $results);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dataGet')){
    function dataGet($target,$key,$default=null){if($key===null){return $target;}$key=\is_array($key)?$key:\explode('.',$key);foreach($key as $i=>$segment){unset($key[$i]);if($segment===null){return $target;}if($segment==='*'){if(!\is_array($target)){return $default;}$result=[];foreach($target as $item){$result[]=\Inilim\Tool\Method\Arr\dataGet($item,$key);}return \in_array('*',$key)?\Inilim\Tool\Method\Arr\collapse($result):$result;}if(\Inilim\Tool\Arr :: accessible($target)&&\Inilim\Tool\Arr :: exists($target,$segment)){$target=$target[$segment];}elseif(\is_object($target)&&isset($target ->{$segment})){$target=$target ->{$segment};}else{return $default;}}return $target;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dotKeys')){
    function dotKeys(iterable $array,string $prepend=''){$results=[];foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$results=\array_merge($results,\Inilim\Tool\Method\Arr\dotKeys($value,$prepend.$key.'.'));}else{$results[]=$prepend.$key;}}return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dotKeysByPattern')){
    function dotKeysByPattern(iterable $target,string $dotPattern){$regex='#^'.\str_replace('\*','[^\.]+',\preg_quote($dotPattern)).'#';return \array_values(\array_filter(\Inilim\Tool\Method\Arr\dotKeys($target),static fn($key)=>\preg_match($regex,$key)));}
    }if(!\Inilim\Tool\Arr::__definedIfNot('only')){
    function only(array $array,$keys):array{return \array_intersect_key($array,\array_flip((array) $keys));}
    }}namespace Inilim\Tool\Method\String{if(!\Inilim\Tool\Str::__definedIfNot('_contains')){
    function _contains(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_contains($haystack,$needle);}return ''===$needle||false!==strpos($haystack,$needle);}
    }if(!\Inilim\Tool\Str::__definedIfNot('contains')){
    function contains(string $haystack,$needles,bool $ignoreCase=false){if($ignoreCase){$haystack=\mb_strtolower($haystack,'UTF-8');}if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($ignoreCase){$needle=\mb_strtolower($needle,'UTF-8');}if($needle!==''&&\Inilim\Tool\Method\String\_contains($haystack,$needle)){return true;}}return false;}
    }}