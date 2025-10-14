<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Json{function getNativeTypeFromJson(?string $v):?string{if($v===null){return null;}$v=\Inilim\Tool\Method\Json\decode($v,false);if(\Inilim\Tool\Method\Json\hasError()){return null;}return \gettype($v);}if(!\Inilim\Tool\Json::__definedIfNot('decode')){
    function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){return \json_decode($v,$associative,$depth,$flags);}
    }if(!\Inilim\Tool\Json::__definedIfNot('hasError')){
    function hasError():bool{return \json_last_error()!==\JSON_ERROR_NONE;}
    }}