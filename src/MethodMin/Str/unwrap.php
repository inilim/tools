<?php

namespace Inilim\Tool\Method\Str{function unwrap(string $value,string $before,?string $after=null):string{if(\Inilim\Tool\Method\Str\startsWith($value,$before)){$value=\Inilim\Tool\Method\Str\substr($value,\Inilim\Tool\Method\Str\length($before));}if(\Inilim\Tool\Method\Str\endsWith($value,$after ??= $before)){$value=\Inilim\Tool\Method\Str\substr($value,0,-\Inilim\Tool\Method\Str\length($after));}return $value;}if(!\Inilim\Tool\Str::__definedIfNot('_endsWith')){
    function _endsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_ends_with($haystack,$needle);}if(''===$needle||$needle===$haystack){return true;}if(''===$haystack){return false;}$needleLength=\strlen($needle);return $needleLength<=\strlen($haystack)&&0===\substr_compare($haystack,$needle,-$needleLength);}
    }if(!\Inilim\Tool\Str::__definedIfNot('_startsWith')){
    function _startsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }if(!\Inilim\Tool\Str::__definedIfNot('endsWith')){
    function endsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\Str\_endsWith($haystack,$needle)){return true;}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('length')){
    function length(string $value,$encoding='UTF-8'){return \mb_strlen($value,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('startsWith')){
    function startsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\Str\_startsWith($haystack,$needle)){return true;}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }}