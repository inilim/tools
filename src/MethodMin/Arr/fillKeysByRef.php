<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function fillKeysByRef():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(array&$array,array $keys,$value,bool $overwrite=true){foreach($keys as $key){if($overwrite||!\array_key_exists($key,$array)){$array[$key]=$value;}}};}}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}