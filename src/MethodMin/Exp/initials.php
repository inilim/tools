<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp{function initials(string $value,string $separator=''){$value=\Inilim\Tool\Method\Str\trim($value);$value=\Inilim\Tool\Method\Str\unixNewLines($value,"\\s");return \implode($separator,\array_map(static fn($word)=>\mb_strtoupper(\mb_substr($word,0,1,'UTF-8'),'UTF-8'),\preg_split('/\s+/',$value)));}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null){if($charlist===null){$trimDefaultCharacters=\preg_quote(" \n\r\t\v\x00");return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+|[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }if(!\Inilim\Tool\Str::__definedIfNot('unixNewLines')){
    function unixNewLines(string $s,string $replacement="\n"):string{return \preg_replace("#\r\n?| | #",$replacement,$s);}
    }}