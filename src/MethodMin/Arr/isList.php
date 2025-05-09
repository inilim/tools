<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function isList(array $array):bool{return \Inilim\Tool\Method\PF\array_is_list($array);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_is_list')){
    function array_is_list(array $array):bool{if(\Inilim\Tool\Method\Check\php81()){return \array_is_list($array);}if([]===$array||$array===\array_values($array)){return true;}$nextKey=-1;foreach($array as $k=>$v){if($k!==++$nextKey){return false;}}return true;}
    }}