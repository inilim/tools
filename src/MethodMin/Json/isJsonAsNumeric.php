<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Json{function isJsonAsNumeric(?string $v):bool{if($v===null){return false;}$v=\Inilim\Tool\Method\Json\decode($v);if(\Inilim\Tool\Method\Json\hasError()){return false;}return \Inilim\Tool\Method\Integer\isNumeric($v);}if(!\Inilim\Tool\Json::__definedIfNot('decode')){
    function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){return \json_decode($v,$associative,$depth,$flags);}
    }if(!\Inilim\Tool\Json::__definedIfNot('hasError')){
    function hasError():bool{return \json_last_error()!==\JSON_ERROR_NONE;}
    }}namespace Inilim\Tool\Method\Integer{if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{$t=\gettype($v);if(!\in_array($t,['string','integer'],true)){return false;}if($t==='integer'||\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',$v)){return true;}return false;}
    }}