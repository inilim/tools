<?php

namespace Inilim\Tool\Method\String{function replaceEnd(string $search,string $replace,string $subject):string{if($search===''){return $subject;}if(\Inilim\Tool\Method\String\endsWith($subject,$search)){return \Inilim\Tool\Method\String\replaceLast($search,$replace,$subject);}return $subject;}if(!\Inilim\Tool\Str::__definedIfNot('_endsWith')){
    function _endsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_ends_with($haystack,$needle);}if(''===$needle||$needle===$haystack){return true;}if(''===$haystack){return false;}$needleLength=\strlen($needle);return $needleLength<=\strlen($haystack)&&0===\substr_compare($haystack,$needle,-$needleLength);}
    }if(!\Inilim\Tool\Str::__definedIfNot('endsWith')){
    function endsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\String\_endsWith($haystack,$needle)){return true;}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('replaceLast')){
    function replaceLast(string $search,string $replace,string $subject):string{if($search===''){return $subject;}$position=\strrpos($subject,$search);if($position!==false){return \substr_replace($subject,$replace,$position,\strlen($search));}return $subject;}
    }}