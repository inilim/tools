<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function exceptNestedArray(array $array,$keys,int $depth=1):array{return \Inilim\Tool\Method\Arr\nestedMap($array,$depth,static function($value)use($keys){return \Inilim\Tool\Method\Arr\except($value,$keys);});}if(!\Inilim\Tool\Arr::__definedIfNot('except')){
    function except(array $array,$keys):array{\Inilim\Tool\Method\Arr\forget()($array,$keys);return $array;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('forget')){
    function forget(){\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(array&$array,$keys){$original=&$array;$keys=(array) $keys;if(!$keys){return;}foreach($keys as $key){$key=(string) $key;if(\Inilim\Tool\Method\Arr\exists($array,$key)){unset($array[$key]);continue;}$parts=\explode('.',$key);$array=&$original;while(\sizeof($parts)>1){$part=\array_shift($parts);if(isset($array[$part])&&\is_array($array[$part])){$array=&$array[$part];}else{continue 2;}}unset($array[\array_shift($parts)]);}};}
    }if(!\Inilim\Tool\Arr::__definedIfNot('nestedMap')){
    function nestedMap(array $array,int $depth,callable $callable):array{$internal=static function(array&$array,$key,int $depth,callable $callable)use(&$internal):array{if($depth<=0){return $callable($array,$key);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=$internal($item,$idx,$depth-1,$callable);}}return $array;};return $internal($array,null,$depth,$callable);}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}