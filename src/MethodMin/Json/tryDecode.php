<?php

namespace Inilim\Tool\Method\Json{function tryDecode(string $v,?bool $associative=null,int $depth=512,int $flags=0,$default=null){try{/*// @phpstan-ignore-next-line*/$v=\json_decode($v,$associative,$depth,$flags);}catch(\JsonException $e){return $default;}if(\Inilim\Tool\Method\Json\hasError()){return $default;}return $v;}if(!\Inilim\Tool\Json::__definedIfNot('hasError')){
    function hasError(){return \json_last_error()!==\JSON_ERROR_NONE;}
    }}