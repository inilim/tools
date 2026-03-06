<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function insertBefore():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(array&$array,$key,array $inserted){$offset=$key===null?0:(int) \Inilim\Tool\Method\Arr\getKeyOffset($array,$key);$array=\array_slice($array,0,$offset,true)+$inserted+\array_slice($array,$offset,\sizeof($array),true);};}if(!\Inilim\Tool\Arr::__definedIfNot('getKeyOffset')){
    function getKeyOffset(array $array,$key){$value=\array_search(\key([$key=>null]),\array_keys($array),true);return $value===false?null:$value;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}