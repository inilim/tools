<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json{function tryDecodeAsObject(?string $v,$default=null){if($v===null){return $default;}$v=\Inilim\Tool\Method\Json\decode($v);if(\is_object($v)){return $v;}return $default;}if(!\Inilim\Tool\Json::__definedIfNot('decode')){
    function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){/*// @phpstan-ignore-next-line*/return \json_decode($v,$associative,$depth,$flags);}
    }}