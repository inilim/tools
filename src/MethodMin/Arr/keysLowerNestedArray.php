<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function keysLowerNestedArray(array $array,int $depth=1):array{return \Inilim\Tool\Method\Arr\nestedMap($array,$depth,static function(array $value){return \Inilim\Tool\Method\Arr\keysLower($value);});}if(!\Inilim\Tool\Arr::__definedIfNot('keysLower')){
    function keysLower(array $array):array{return \array_change_key_case($array,\CASE_LOWER);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('nestedMap')){
    function nestedMap(array $array,int $depth,callable $callable):array{$internal=static function(array&$array,$key,int $depth,callable $callable)use(&$internal):array{if($depth<=0){return $callable($array,$key);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=$internal($item,$idx,$depth-1,$callable);}}return $array;};$result=$internal($array,null,$depth,$callable);$internal=null;return $result;}
    }}