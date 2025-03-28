<?php

namespace Inilim\Tool\Method\Str{function nl2space(string $str,string $replace=' ',bool $squish=false):string{$str=\str_replace(["\r\n","\n\r","\n","\r"],$replace,$str);return $squish?\Inilim\Tool\Method\Str\squish($str):$str;}if(!\Inilim\Tool\Str::__definedIfNot('squish')){
    function squish(string $value){return \preg_replace('#(\s|\x{3164}|\x{1160})+#u',' ',\Inilim\Tool\Method\Str\trim($value));}
    }if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null){if($charlist===null){return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}]+|[\s\x{FEFF}\x{200B}\x{200E}]+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }}