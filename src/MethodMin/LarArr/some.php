<?php

declare(strict_types=1);namespace Inilim\Tool\Method\LarArr{function some($array,callable $callback){return \Inilim\Tool\Method\PF\array_any($array,$callback);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php84')){
    function php84():bool{return \PHP_VERSION_ID>=80400?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_any')){
    function array_any(array $array,callable $callback):bool{if(\Inilim\Tool\Method\Check\php84()){return \array_any($array,$callback);}foreach($array as $key=>$value){if($callback($value,$key)){return true;}}return false;}
    }}