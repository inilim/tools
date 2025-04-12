<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json{function isJsonAsArrList(?string $v){if($v===null){return false;}$v=\Inilim\Tool\Method\Json\decode($v);if(\Inilim\Tool\Method\Json\hasError()||!\is_array($v)||!\Inilim\Tool\Method\Arr\isList($v)){return false;}return true;}if(!\Inilim\Tool\Json::__definedIfNot('decode')){
    function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){return \json_decode($v,$associative,$depth,$flags);}
    }if(!\Inilim\Tool\Json::__definedIfNot('hasError')){
    function hasError(){return \json_last_error()!==\JSON_ERROR_NONE;}
    }}namespace Inilim\Tool\Method\Arr{if(!\Inilim\Tool\Arr::__definedIfNot('isList')){
    function isList(array $array){if(\PHP_VERSION_ID>=80100){return \array_is_list($array);}if([]===$array||$array===\array_values($array)){return true;}$nextKey=-1;foreach($array as $k=>&$v){if($k!==++$nextKey){return false;}}return true;}
    }}