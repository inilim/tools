<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function array_find_key(array $array,callable $callback){if(\Inilim\Tool\Method\Check\php84()){return \array_find_key($array,$callback);}foreach($array as $key=>$value){if($callback($value,$key)){return $key;}}return null;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php84')){
    function php84():bool{return \PHP_VERSION_ID>=80400?true:false;}
    }}