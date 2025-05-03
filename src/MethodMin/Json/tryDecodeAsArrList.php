<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json{function tryDecodeAsArrList(?string $v,$default=null){if($v===null){return $default;}$v=\Inilim\Tool\Method\Json\decode($v);if(\is_array($v)&&\Inilim\Tool\Method\Arr\isList($v)){return $v;}return $default;}if(!\Inilim\Tool\Json::__definedIfNot('decode')){
    function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){return \json_decode($v,$associative,$depth,$flags);}
    }}namespace Inilim\Tool\Method\Arr{if(!\Inilim\Tool\Arr::__definedIfNot('isList')){
    function isList(array $array):bool{if(\PHP_VERSION_ID>=80100){return \array_is_list($array);}if([]===$array||$array===\array_values($array)){return true;}$nextKey=-1;foreach($array as $k=>&$v){if($k!==++$nextKey){return false;}}return true;}
    }}