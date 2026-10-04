<?php

declare(strict_types=1);namespace Inilim\Tool\Method\LarStr{function isAscii($value){return \Inilim\Tool\Method\Str\is_ascii((string) $value);}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('is_ascii')){
    function is_ascii(string $str):bool{if($str===''){return true;}return!\preg_match('/'."[^\t\x10\x13\n\r -~]".'/',$str);}
    }}