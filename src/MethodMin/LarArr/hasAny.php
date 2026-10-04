<?php

namespace Inilim\Tool\Method\LarArr{function hasAny($array,$keys){if(\is_null($keys)){return false;}$keys=(array) $keys;if(!$array){return false;}if($keys===[]){return false;}return \Inilim\Tool\Method\PF\array_any($keys,static fn($key)=>\Inilim\Tool\Method\LarArr\has($array,$key));}if(!\Inilim\Tool\LarArr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}if(\is_float($key)||\is_null($key)){$key=(string) $key;}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('has')){
    function has($array,$keys){$keys=(array) $keys;if(!$array||$keys===[]){return false;}foreach($keys as $key){$subKeyArray=$array;if(\Inilim\Tool\Method\LarArr\exists($array,$key)){continue;}foreach(\explode('.',$key)as $segment){if(\Inilim\Tool\Method\LarArr\accessible($subKeyArray)&&\Inilim\Tool\Method\LarArr\exists($subKeyArray,$segment)){$subKeyArray=$subKeyArray[$segment];}else{return false;}}}return true;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php84')){
    function php84():bool{return \PHP_VERSION_ID>=80400?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_any')){
    function array_any(array $array,callable $callback):bool{if(\Inilim\Tool\Method\Check\php84()){return \array_any($array,$callback);}foreach($array as $key=>$value){if($callback($value,$key)){return true;}}return false;}
    }}