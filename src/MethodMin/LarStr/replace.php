<?php

namespace Inilim\Tool\Method\LarStr{function replace($search,$replace,$subject,$caseSensitive=true){if($search instanceof \Traversable){$search=\iterator_to_array($search);}if($replace instanceof \Traversable){$replace=\iterator_to_array($replace);}if($subject instanceof \Traversable){$subject=\iterator_to_array($subject);}return $caseSensitive?\str_replace($search,$replace,$subject):\Inilim\Tool\Method\LarStr\__replaceWhileIgnoringCase($search,$replace,$subject);}if(!\Inilim\Tool\LarStr::__definedIfNot('isAscii')){
    function isAscii($value){return \Inilim\Tool\Method\Str\is_ascii((string) $value);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('__replaceWhileIgnoringCase')){
    function __replaceWhileIgnoringCase($search,$replace,$subject){if(!\is_array($search)&&\is_array($replace)){return \str_ireplace($search,$replace,$subject);}$searches=\is_array($search)?\array_values($search):[$search];if(\Inilim\Tool\Method\PF\array_all($searches,'\Inilim\Tool\Method\LarStr\isAscii')){return \str_ireplace($search,$replace,$subject);}$replacements=\is_array($replace)?\array_values($replace):\array_fill(0,\count($searches),$replace);foreach([... $searches,... $replacements,... (array) $subject]as $value){if(!\preg_match('//u',(string) $value)){return \str_ireplace($search,$replace,$subject);}}foreach($searches as $index=>$term){$term=(string) $term;if($term===''){continue;}$replacement=(string)($replacements[$index]?? '');$subject=\Inilim\Tool\Method\LarStr\isAscii($term)?\str_ireplace($term,$replacement,$subject):\preg_replace_callback('/'.\preg_quote($term,'/').'/iu',static fn()=>$replacement,$subject);}return $subject;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('is_ascii')){
    function is_ascii(string $str):bool{if($str===''){return true;}return!\preg_match('/'."[^\t\x10\x13\n\r -~]".'/',$str);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php84')){
    function php84():bool{return \PHP_VERSION_ID>=80400?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_all')){
    function array_all(array $array,callable $callback):bool{if(\Inilim\Tool\Method\Check\php84()){return \array_all($array,$callback);}foreach($array as $key=>$value){if(!$callback($value,$key)){return false;}}return true;}
    }}