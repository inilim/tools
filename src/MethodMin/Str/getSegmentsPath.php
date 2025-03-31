<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function getSegmentsPath(string $path):array{$t=\trim(\Inilim\Tool\Method\Str\trim($path),'/');if($t===''){return[];}$t=\preg_replace('#\/{2,}#','/',$t);return \explode('/',$t);}if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null){if($charlist===null){return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}]+|[\s\x{FEFF}\x{200B}\x{200E}]+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }}