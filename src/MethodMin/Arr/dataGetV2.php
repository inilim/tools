<?php

namespace Inilim\Tool\Method\Arr{function dataGetV2($target,$key,$default=null){if($key===null){return $target;}if(\is_array($key)||\is_int($key)||!\Inilim\Tool\Method\Str\contains($key,'*')){return \Inilim\Tool\Method\Lar\dataGet($target,$key,$default);}$keys=\Inilim\Tool\Method\Arr\dotKeysByPattern($target,$key);if(!$keys){return \Inilim\Tool\Method\Lar\value($default);}return \Inilim\Tool\Method\Lar\dataGet(\Inilim\Tool\Method\LarArr\undot(\Inilim\Tool\Method\LarArr\only(\Inilim\Tool\Method\LarArr\dot($target),$keys)),$key,$default);}if(!\Inilim\Tool\Arr::__definedIfNot('dotKeys')){
    function dotKeys(iterable $array,string $prepend=''):array{$results=[];$flatten=static function(iterable $array,string $prefix)use(&$results,&$flatten){foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$flatten($value,$prefix.$key.'.');}else{$results[]=$prefix.$key;}}};$flatten($array,$prepend);$flatten=null;return $results;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('dotKeysByPattern')){
    function dotKeysByPattern(iterable $target,string $dotPattern):array{$regex='#^'.\str_replace('\*','[^\.]+',\preg_quote($dotPattern)).'#';return \array_values(\array_filter(\Inilim\Tool\Method\Arr\dotKeys($target),static fn($key)=>\preg_match($regex,$key)));}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('contains')){
    function contains(string $haystack,$needles,bool $ignoreCase=false):bool{if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($needle!==''){if($ignoreCase){if(\Inilim\Tool\Method\Str\iContainsOnce($haystack,$needle)){return true;}}elseif(\Inilim\Tool\Method\PF\str_contains($haystack,$needle)){return true;}}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('iContainsOnce')){
    function iContainsOnce(string $haystack,string $needle):bool{\Inilim\Tool\Method\Assert\extPhp('mbstring');return ''===$needle||\mb_stripos($haystack,$needle,0,'UTF-8')!==false;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&false===$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(false===\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('collapse')){
    function collapse($array){$results=[];foreach($array as $values){if($values instanceof \Traversable){$values=\iterator_to_array($values);}elseif(is_array($values)){$results[]=$values;}}return \array_merge([],... $results);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('dot')){
    function dot($array,$prepend='',$depth=\INF){$results=[];$flatten=static function($data,$prefix,$currentDepth)use(&$results,&$flatten,$depth):void{foreach($data as $key=>$value){$newKey=$prefix.$key;if(\is_array($value)&&!empty($value)&&$currentDepth<$depth){$flatten($value,$newKey.'.',$currentDepth+1);}else{$results[$newKey]=$value;}}};$flatten($array,$prepend,0);$flatten=null;return $results;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}if(\is_float($key)||\is_null($key)){$key=(string) $key;}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('from')){
    function from($items){$type=\gettype($items);if($type==='array'){return $items;}elseif($type==='object'){if(false){}elseif(\method_exists($items,'toArray')){return $items -> toArray();}elseif(\method_exists($items,'toJson')){return (array) \json_decode($items -> toJson(),true);}elseif(\Inilim\Tool\Method\Check\php80()&&$items instanceof \WeakMap){return \iterator_to_array($items,false);}elseif($items instanceof \Traversable){return \iterator_to_array($items);}elseif($items instanceof \JsonSerializable){return (array) $items -> jsonSerialize();}else{return (array) $items;}}throw new \InvalidArgumentException('Items cannot be represented by a scalar value.');}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('only')){
    function only($array,$keys){return \array_intersect_key($array,\array_flip((array) $keys));}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('set')){
    function set():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(&$array,$key,$value){if(\is_null($key)){return $array=$value;}$keys=\explode('.',$key);foreach($keys as $i=>$key){if(\count($keys)===1){break;}unset($keys[$i]);if(!isset($array[$key])||!\is_array($array[$key])){$array[$key]=[];}$array=&$array[$key];}$array[\array_shift($keys)]=$value;return $array;};}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('undot')){
    function undot($array){$results=[];$set=\Inilim\Tool\Method\LarArr\set();foreach($array as $key=>$value){$set($results,$key,$value);}return $results;}
    }}namespace Inilim\Tool\Method\Lar{if(!\Inilim\Tool\Lar::__definedIfNot('dataGet')){
    function dataGet($target,$key,$default=null){if(\is_null($key)){return $target;}$key=\is_array($key)?$key:\explode('.',$key);foreach($key as $i=>$segment){unset($key[$i]);if(\is_null($segment)){return $target;}if($segment==='*'){if(\is_object($target)){$target=\Inilim\Tool\Method\LarArr\from($target);}elseif(!\is_iterable($target)){return \Inilim\Tool\Method\Lar\value($default);}$result=[];foreach($target as $item){$result[]=\Inilim\Tool\Method\Lar\dataGet($item,$key);}return \in_array('*',$key)?\Inilim\Tool\Method\LarArr\collapse($result):$result;}if($segment==='\*'){$segment='*';}elseif($segment==='\{first}'){$segment='{first}';}elseif($segment==='{first}'){$segment=\array_key_first(\is_array($target)?$target:\Inilim\Tool\Method\LarArr\from($target));}elseif($segment==='\{last}'){$segment='{last}';}elseif($segment==='{last}'){$segment=\array_key_last(\is_array($target)?$target:\Inilim\Tool\Method\LarArr\from($target));}if(\Inilim\Tool\Method\LarArr\accessible($target)&&\Inilim\Tool\Method\LarArr\exists($target,$segment)){$target=$target[$segment];}elseif(\is_object($target)&&isset($target ->{$segment})){$target=$target ->{$segment};}else{return \Inilim\Tool\Method\Lar\value($default);}}return $target;}
    }if(!\Inilim\Tool\Lar::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}