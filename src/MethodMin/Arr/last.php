<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function last(iterable $array,?callable $callback=null,$default=null){if($callback===null){return empty($array)?\Inilim\Tool\Method\Arr\value($default):\Inilim\Tool\Method\PF\array_last($array);}return \Inilim\Tool\Method\Arr\head(\array_reverse($array,true),$callback,$default);}if(!\Inilim\Tool\Arr::__definedIfNot('head')){
    function head(iterable $array,?callable $callback=null,$default=null){if($callback===null){if(empty($array)){return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $key=>$value){if($callback($value,$key)){return $value;}}return \Inilim\Tool\Method\Arr\value($default);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php85')){
    function php85():bool{return \PHP_VERSION_ID>=80500?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_last')){
    function array_last(array $array){if(\Inilim\Tool\Method\Check\php85()){return \array_last($array);}return $array?\current(\array_slice($array,-1)):null;}
    }}