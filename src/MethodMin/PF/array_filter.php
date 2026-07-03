<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function array_filter(array $array,?callable $callback=null,int $mode=0):array{if($callback!==null){return \array_filter($array,$callback,$mode);}if(\Inilim\Tool\Method\Check\php80()){return \array_filter($array,null,$mode);}foreach($array as $k=>$v){if(false===(bool) $v){unset($array[$k]);}}return $array;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}