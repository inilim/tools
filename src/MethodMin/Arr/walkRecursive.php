<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function walkRecursive():\Closure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(&$array,callable $callable){$depth=0;$recursive=static function(&$array,$callable,$recursive)use(&$depth){foreach($array as $key=>&$value){$callable($value,$key,$depth);if(\is_iterable($value)){$depth++;$recursive($value,$callable,$recursive);$depth--;}}};$recursive($array,$callable,$recursive);};}}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}