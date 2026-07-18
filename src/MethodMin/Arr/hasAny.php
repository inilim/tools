<?php

namespace Inilim\Tool\Method\Arr{function hasAny($array,$keys):bool{if($keys===null){return false;}$keys=(array) $keys;if(!$array){return false;}if($keys===[]){return false;}foreach($keys as $key){if(\Inilim\Tool\Method\LarArr\has($array,$key)){return true;}}return false;}}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}if(\is_float($key)||\is_null($key)){$key=(string) $key;}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\LarArr::__definedIfNot('has')){
    function has($array,$keys){$keys=(array) $keys;if(!$array||$keys===[]){return false;}foreach($keys as $key){$subKeyArray=$array;if(\Inilim\Tool\Method\LarArr\exists($array,$key)){continue;}foreach(\explode('.',$key)as $segment){if(\Inilim\Tool\Method\LarArr\accessible($subKeyArray)&&\Inilim\Tool\Method\LarArr\exists($subKeyArray,$segment)){$subKeyArray=$subKeyArray[$segment];}else{return false;}}}return true;}
    }}