<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function last(iterable $array,?callable $callback=null,$default=null){if($callback===null){return empty($array)?\Inilim\Tool\Method\Arr\value($default):\end($array);}return \Inilim\Tool\Method\Arr\head(\array_reverse($array,true),$callback,$default);}if(!\Inilim\Tool\Arr::__definedIfNot('head')){
    function head(iterable $array,?callable $callback=null,$default=null){if($callback===null){if(empty($array)){return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $key=>$value){if($callback($value,$key)){return $value;}}return \Inilim\Tool\Method\Arr\value($default);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value){return $value instanceof \Closure?$value():$value;}
    }}