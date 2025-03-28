<?php

namespace Inilim\Tool\Method\Str{function iStartsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as&$needle){$needle=\Inilim\Tool\Method\Str\lower($needle);}return \Inilim\Tool\Method\Str\startsWith(\Inilim\Tool\Method\Str\lower($haystack),$needles);}if(!\Inilim\Tool\Str::__definedIfNot('_startsWith')){
    function _startsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('startsWith')){
    function startsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\Str\_startsWith($haystack,$needle)){return true;}}return false;}
    }}