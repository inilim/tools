<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function renameKey():\CLosure{\Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__,\func_num_args());return static function(array&$array,$oldKey,$newKey){$offset=\Inilim\Tool\Method\Arr\getKeyOffset($array,$oldKey);if($offset===null){return false;}$val=&$array[$oldKey];$keys=\array_keys($array);$keys[$offset]=$newKey;$array=\array_combine($keys,$array);$array[$newKey]=&$val;return true;};}if(!\Inilim\Tool\Arr::__definedIfNot('getKeyOffset')){
    function getKeyOffset(array $array,$key){$value=\array_search(\key([$key=>null]),\array_keys($array),true);return $value===false?null:$value;}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('__notArgsHere')){
    function __notArgsHere(string $fnName,int $countArgs){if($countArgs!==0){$fnName=\basename($fnName);throw new \InvalidArgumentException(\sprintf('%s()(...) OR %s()->__invoke(...) <-- The arguments were passed to the wrong place',$fnName,$fnName));}}
    }}