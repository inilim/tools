<?php

namespace Inilim\Tool\Method\LarArr{function first($array,?callable $callback=null,$default=null){if(\is_null($callback)){if(empty($array)){return \Inilim\Tool\Method\Lar\value($default);}if(\is_array($array)){return \Inilim\Tool\Method\PF\array_first($array);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Lar\value($default);}$key=\Inilim\Tool\Method\PF\array_find_key($array,$callback);return $key!==null?$array[$key]:\Inilim\Tool\Method\Lar\value($default);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php84')){
    function php84():bool{return \PHP_VERSION_ID>=80400?true:false;}
    }if(!\Inilim\Tool\Check::__definedIfNot('php85')){
    function php85():bool{return \PHP_VERSION_ID>=80500?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_find_key')){
    function array_find_key(array $array,callable $callback){if(\Inilim\Tool\Method\Check\php84()){return \array_find_key($array,$callback);}foreach($array as $key=>$value){if($callback($value,$key)){return $key;}}return null;}
    }if(!\Inilim\Tool\PF::__definedIfNot('array_first')){
    function array_first(array $array){if(\Inilim\Tool\Method\Check\php85()){return \array_first($array);}foreach($array as $value){return $value;}return null;}
    }}namespace Inilim\Tool\Method\Lar{if(!\Inilim\Tool\Lar::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}