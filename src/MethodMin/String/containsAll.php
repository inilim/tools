<?php

namespace Inilim\Tool\Method\String{function containsAll(string $haystack,iterable $needles,bool $ignoreCase=false){foreach($needles as $needle){if(!\Inilim\Tool\Method\String\contains($haystack,$needle,$ignoreCase)){return false;}}return true;}if(!\Inilim\Tool\Str::__definedIfNot('_contains')){
    function _contains(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_contains($haystack,$needle);}return ''===$needle||false!==strpos($haystack,$needle);}
    }if(!\Inilim\Tool\Str::__definedIfNot('contains')){
    function contains(string $haystack,$needles,bool $ignoreCase=false){if($ignoreCase){$haystack=\mb_strtolower($haystack,'UTF-8');}if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($ignoreCase){$needle=\mb_strtolower($needle,'UTF-8');}if($needle!==''&&\Inilim\Tool\Method\String\_contains($haystack,$needle)){return true;}}return false;}
    }}