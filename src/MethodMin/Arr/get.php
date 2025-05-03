<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function get($array,$key,$default=null){if(!\Inilim\Tool\Method\Arr\accessible($array)){return \Inilim\Tool\Method\Arr\value($default);}if($key===null){return $array;}if(\Inilim\Tool\Method\Arr\exists($array,$key)){return $array[$key];}if(\strpos(\strval($key),'.')===false){return $array[$key]?? \Inilim\Tool\Method\Arr\value($default);}foreach(\explode('.',\strval($key))as $segment){if(\Inilim\Tool\Method\Arr\accessible($array)&&\Inilim\Tool\Method\Arr\exists($array,$segment)){$array=$array[$segment];}else{return \Inilim\Tool\Method\Arr\value($default);}}return $array;}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('value')){
    function value($value){return $value instanceof \Closure?$value():$value;}
    }}