<?php

namespace Inilim\Tool\Method\Json{function tryDecodeAsArray(?string $v,$default=null){if($v===null){return $default;}$v=\Inilim\Tool\Method\Json\decode($v,true);if(\is_array($v)){return $v;}return $default;}if(!\Inilim\Tool\Json::__definedIfNot('decode')){
    function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){/*// @phpstan-ignore-next-line*/return \json_decode($v,$associative,$depth,$flags);}
    }}