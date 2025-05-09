<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function sole(array $array,?callable $callback=null){if($callback){$array=\Inilim\Tool\Method\Arr\where($array,$callback);}$count=\sizeof($array);if($count===0){throw new \Exception('Item not found');}if($count>1){throw new \Exception('Multiple items found: '.$count);}return \Inilim\Tool\Method\Arr\first($array);}if(!\Inilim\Tool\Arr::__definedIfNot('first')){
    function first($array,?callable $callback=null,$default=null){if($callback===null){if(empty($array)){return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $item){return $item;}return \Inilim\Tool\Method\Arr\value($default);}foreach($array as $key=>$value){if($callback($value,$key)){return $value;}}return \Inilim\Tool\Method\Arr\value($default);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('where')){
    function where(array $array,callable $callback,bool $preserveKeys=true):array{$result=\array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);return $preserveKeys?$result:\array_values($result);}
    }}