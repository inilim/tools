<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json{function getTypeFromJson(?string $v){if($v===null){return null;}$v=\Inilim\Tool\Method\Json\decode($v,false);if(\Inilim\Tool\Method\Json\hasError()){return null;}return \Inilim\Tool\Method\Other\getType($v);}if(!\Inilim\Tool\Json::__definedIfNot('decode')){
    function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){return \json_decode($v,$associative,$depth,$flags);}
    }if(!\Inilim\Tool\Json::__definedIfNot('hasError')){
    function hasError(){return \json_last_error()!==\JSON_ERROR_NONE;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v){$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}elseif($v instanceof \Throwable){return 'object exception';}return 'object';case 'boolean':return 'bool';case 'integer':return 'int';default:return $r;}}
    }}