<?php

namespace Inilim\Tool\Method\Arr{function get($array,$key,$default=null){if(!\Inilim\Tool\Method\LarArr\accessible($array)){return \Inilim\Tool\Method\Lar\value($default);}if($key===null){return $array;}if(\Inilim\Tool\Method\LarArr\exists($array,$key)){return $array[$key];}if(\strpos(\strval($key),'.')===false){return $array[$key]?? \Inilim\Tool\Method\Lar\value($default);}foreach(\explode('.',\strval($key))as $segment){if(\Inilim\Tool\Method\LarArr\accessible($array)&&\Inilim\Tool\Method\LarArr\exists($array,$segment)){$array=$array[$segment];}else{return \Inilim\Tool\Method\Lar\value($default);}}return $array;}}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}if(\is_float($key)||\is_null($key)){$key=(string) $key;}return \array_key_exists($key,$array);}
    }}namespace Inilim\Tool\Method\Lar{if(!\Inilim\Tool\Lar::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}