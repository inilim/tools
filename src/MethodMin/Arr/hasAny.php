<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function hasAny($array,$keys):bool{if($keys===null){return false;}$keys=(array) $keys;if(!$array){return false;}if($keys===[]){return false;}foreach($keys as $key){if(\Inilim\Tool\Method\Arr\has($array,$key)){return true;}}return false;}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }if(!\Inilim\Tool\Arr::__definedIfNot('has')){
    function has($array,$keys):bool{$keys=(array) $keys;if(!$array||$keys===[]){return false;}foreach($keys as $key){$subKeyArray=$array;if(\Inilim\Tool\Method\Arr\exists($array,$key)){continue;}foreach(\explode('.',$key)as $segment){if(\Inilim\Tool\Method\Arr\accessible($subKeyArray)&&\Inilim\Tool\Method\Arr\exists($subKeyArray,$segment)){$subKeyArray=$subKeyArray[$segment];}else{return false;}}}return true;}
    }}