<?php

namespace Inilim\Tool\Method\Str{function iEndsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as&$needle){$needle=\Inilim\Tool\Method\Str\lower($needle);}return \Inilim\Tool\Method\Str\endsWith(\Inilim\Tool\Method\Str\lower($haystack),$needles);}if(!\Inilim\Tool\Str::__definedIfNot('_endsWith')){
    function _endsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_ends_with($haystack,$needle);}if(''===$needle||$needle===$haystack){return true;}if(''===$haystack){return false;}$needleLength=\strlen($needle);return $needleLength<=\strlen($haystack)&&0===\substr_compare($haystack,$needle,-$needleLength);}
    }if(!\Inilim\Tool\Str::__definedIfNot('endsWith')){
    function endsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\Str\_endsWith($haystack,$needle)){return true;}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }}