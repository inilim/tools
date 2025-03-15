<?php

namespace Inilim\Tool\Method\String{function getCountSegmentsPath(string $path){$t=\trim(\Inilim\Tool\Method\String\trim($path),'/');if($t===''){return 0;}$t=\preg_replace('#\/{2,}#','/',$t);return \substr_count($t,'/');}if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null){if($charlist===null){return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}]+|[\s\x{FEFF}\x{200B}\x{200E}]+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }}