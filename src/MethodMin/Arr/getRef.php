<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function getRef():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function&(array&$array,$key){foreach(\is_array($key)?$key:[$key]as $k){if(\is_array($array)||$array===null){$array=&$array[$k];}else{throw new \InvalidArgumentException('Traversed item is not an array.');}}return $array;};}}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}