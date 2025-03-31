<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function has($array,$keys){$keys=(array) $keys;if(!$array||$keys===[]){return false;}foreach($keys as $key){$subKeyArray=$array;if(\Inilim\Tool\Method\Arr\exists($array,$key)){continue;}foreach(\explode('.',$key)as $segment){if(\Inilim\Tool\Method\Arr\accessible($subKeyArray)&&\Inilim\Tool\Method\Arr\exists($subKeyArray,$segment)){$subKeyArray=$subKeyArray[$segment];}else{return false;}}}return true;}if(!\Inilim\Tool\Arr::__definedIfNot('accessible')){
    function accessible($value){return \is_array($value)||$value instanceof \ArrayAccess;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }}