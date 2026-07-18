<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp{function initials(string $value,string $separator=''){\Inilim\Tool\Method\Assert\extPhp('mbstring');$value=\Inilim\Tool\Method\Str\trim($value);$value=\Inilim\Tool\Method\Str\unixNewLines($value," ");return \implode($separator,\array_map(static fn($word)=>\mb_strtoupper(\mb_substr($word,0,1,'UTF-8'),'UTF-8'),\preg_split('/\s+/',$value)));}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ??= new class{const INVISIBLE_CHARACTERS='\x{0009}\x{0020}\x{00A0}\x{00AD}\x{034F}\x{061C}\x{115F}\x{1160}\x{17B4}\x{17B5}\x{180E}\x{2000}\x{2001}\x{2002}\x{2003}\x{2004}\x{2005}\x{2006}\x{2007}\x{2008}\x{2009}\x{200A}\x{200B}\x{200C}\x{200D}\x{200E}\x{200F}\x{202F}\x{205F}\x{2060}\x{2061}\x{2062}\x{2063}\x{2064}\x{2065}\x{206A}\x{206B}\x{206C}\x{206D}\x{206E}\x{206F}\x{3000}\x{2800}\x{3164}\x{FEFF}\x{FFA0}\x{1D159}\x{1D173}\x{1D174}\x{1D175}\x{1D176}\x{1D177}\x{1D178}\x{1D179}\x{1D17A}\x{E0020}';var $randomStringFactory;};}
    }if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null):string{if($charlist===null){$trimDefaultCharacters=\preg_quote(" \n\r\t\v\x00");$c=\Inilim\Tool\Method\Str\__state():: INVISIBLE_CHARACTERS;return \preg_replace('~^[\s'.$c.$trimDefaultCharacters.']+|[\s'.$c.$trimDefaultCharacters.']+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }if(!\Inilim\Tool\Str::__definedIfNot('unixNewLines')){
    function unixNewLines(string $s,string $replacement="\n"):string{return \preg_replace("/\r\n|\n|\r|".\base64_decode('4oCo',true)."|".\base64_decode('4oCp',true)."/",$replacement,$s);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&false===$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(false===\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }}