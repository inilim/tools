<?php

namespace Inilim\Tool\Method\LarStr{function wordWrap($string,$characters=75,$break="\n",$cutLongWords=false){if(\Inilim\Tool\Method\LarStr\isAscii($string)){return \wordwrap($string,$characters,$break,$cutLongWords);}if($break===''){return \wordwrap($string,$characters,$break,$cutLongWords);}$replaced=[];$skeleton=\preg_replace_callback('/[\x80-\xFF][\x80-\xBF]*|\x1A/',static function($match)use(&$replaced){$replaced[]=$match[0];return "\x1a";},$string);$breakToken="\x00";while(\Inilim\Tool\Method\PF\str_contains($skeleton,$breakToken)){$breakToken .= "\x00";}$index=0;return \implode($break,\array_map(static function($segment)use(&$replaced,&$index){return \preg_replace_callback('/\x1A/',static function()use(&$replaced,&$index){return $replaced[$index++];},$segment);},\explode($breakToken,\wordwrap($skeleton,$characters,$breakToken,$cutLongWords))));}if(!\Inilim\Tool\LarStr::__definedIfNot('isAscii')){
    function isAscii($value){return \Inilim\Tool\Method\Str\is_ascii((string) $value);}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('is_ascii')){
    function is_ascii(string $str):bool{if($str===''){return true;}return!\preg_match('/'."[^\t\x10\x13\n\r -~]".'/',$str);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}