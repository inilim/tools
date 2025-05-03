<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function replaceEnd(string $search,string $replace,string $subject){if($search===''){return $subject;}if(\Inilim\Tool\Method\Str\endsWith($subject,$search)){return \Inilim\Tool\Method\Str\replaceLast($search,$replace,$subject);}return $subject;}if(!\Inilim\Tool\Str::__definedIfNot('endsWith')){
    function endsWith(string $haystack,$needles):bool{if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\PF\str_ends_with($haystack,$needle)){return true;}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('replaceLast')){
    function replaceLast(string $search,string $replace,string $subject){if($search===''){return $subject;}$position=\strrpos($subject,$search);if($position!==false){return \substr_replace($subject,$replace,$position,\strlen($search));}return $subject;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_ends_with')){
    function str_ends_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_ends_with($haystack,$needle);}if(''===$needle||$needle===$haystack){return true;}if(''===$haystack){return false;}$needleLength=\strlen($needle);return $needleLength<=\strlen($haystack)&&0===\substr_compare($haystack,$needle,-$needleLength);}
    }}