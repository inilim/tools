<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function first($array,?callable $callback=null,$default=null){if($callback===null){if(empty($array)){return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $key=>$value){if($callback($value,$key)){return $value;}}return \Inilim\Tool\Method\Arr\value($default);}if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}