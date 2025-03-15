<?php

namespace Inilim\Tool\Method\String{function chopEnd(string $subject,$needle):string{foreach((array) $needle as $n){if(\Inilim\Tool\Method\String\_endsWith($subject,$n)){return \substr($subject,0,-\strlen($n));}}return $subject;}if(!\Inilim\Tool\Str::__definedIfNot('_endsWith')){
    function _endsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_ends_with($haystack,$needle);}if(''===$needle||$needle===$haystack){return true;}if(''===$haystack){return false;}$needleLength=\strlen($needle);return $needleLength<=\strlen($haystack)&&0===\substr_compare($haystack,$needle,-$needleLength);}
    }}