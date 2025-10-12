<?php

namespace Inilim\Tool\Method\LarArr{function string($array,$key,?string $default=null):string{$value=\Inilim\Tool\Method\LarArr\get($array,$key,$default);if(!\is_string($value)){throw new \InvalidArgumentException(\sprintf('Array value for key [%s] must be a string, %s found.',$key,\gettype($value)));}return $value;}if(!\Inilim\Tool\LarArr::__definedIfNot('accessible')){
    function accessible($value){return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}if(\is_float($key)||\is_null($key)){$key=(string) $key;}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('get')){
    function get($array,$key,$default=null){if(!\Inilim\Tool\Method\LarArr\accessible($array)){return \Inilim\Tool\Method\Lar\value($default);}if(\is_null($key)){return $array;}if(\Inilim\Tool\Method\LarArr\exists($array,$key)){return $array[$key];}if(!\Inilim\Tool\Method\PF\str_contains($key,'.')){return \Inilim\Tool\Method\Lar\value($default);}foreach(\explode('.',$key)as $segment){if(\Inilim\Tool\Method\LarArr\accessible($array)&&\Inilim\Tool\Method\LarArr\exists($array,$segment)){$array=$array[$segment];}else{return \Inilim\Tool\Method\Lar\value($default);}}return $array;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}namespace Inilim\Tool\Method\Lar{if(!\Inilim\Tool\Lar::__definedIfNot('value')){
    function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}
    }}