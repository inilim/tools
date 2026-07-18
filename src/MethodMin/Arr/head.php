<?php

namespace Inilim\Tool\Method\Arr{function head(iterable $array,?callable $callback=null,$default=null){if($callback===null){if(empty($array)){return \Inilim\Tool\Method\Lar\value($default);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Lar\value($default);}foreach($array as $key=>$value){if($callback($value,$key)){return $value;}}return \Inilim\Tool\Method\Lar\value($default);}}namespace Inilim\Tool\Method\Lar{if(!\Inilim\Tool\Lar::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}