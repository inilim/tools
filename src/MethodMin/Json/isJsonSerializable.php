<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json{function isJsonSerializable($v,int $flags=0,int $depth=512):bool{return \Inilim\Tool\Method\Json\tryEncode($v,$flags,$depth)===null?false:true;}if(!\Inilim\Tool\Json::__definedIfNot('tryEncode')){
    function tryEncode($v,int $flags=0,int $depth=512,$default=null){try{$json=\json_encode($v,$flags,$depth);}catch(\JsonException $e){return $default;}if($json===false){return $default;}return $json;}
    }}