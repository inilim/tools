<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function doesntEndWith(string $haystack,$needles):bool{return!\Inilim\Tool\Method\Str\endsWith($haystack,$needles);}if(!\Inilim\Tool\Str::__definedIfNot('endsWith')){
    function endsWith(string $haystack,$needles,bool $ignoreCase=false):bool{if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''){if($ignoreCase){if(\Inilim\Tool\Method\Str\iEndsWithOnce($haystack,$needle)){return true;}}elseif(\Inilim\Tool\Method\PF\str_ends_with($haystack,$needle)){return true;}}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('iEndsWithOnce')){
    function iEndsWithOnce(string $haystack,string $needle):bool{return ''===$needle||\mb_stripos($haystack,$needle,-\mb_strlen($needle,'UTF-8'),'UTF-8')!==false;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_ends_with')){
    function str_ends_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_ends_with($haystack,$needle);}if(''===$needle||$needle===$haystack){return true;}if(''===$haystack){return false;}$needleLength=\strlen($needle);return $needleLength<=\strlen($haystack)&&0===\substr_compare($haystack,$needle,-$needleLength);}
    }}