<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json{function isJson(?string $v):bool{if($v===null){return false;}if(\Inilim\Tool\Method\Check\php83()){return \json_validate($v);}\Inilim\Tool\Method\Json\decode($v);return!\Inilim\Tool\Method\Json\hasError();}if(!\Inilim\Tool\Json::__definedIfNot('decode')){
    function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){return \json_decode($v,$associative,$depth,$flags);}
    }if(!\Inilim\Tool\Json::__definedIfNot('hasError')){
    function hasError():bool{return \json_last_error()!==\JSON_ERROR_NONE;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php83')){
    function php83():bool{return \PHP_VERSION_ID>=80300?true:false;}
    }}