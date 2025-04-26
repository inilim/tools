<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function containsAll(string $haystack,iterable $needles,bool $ignoreCase=false){foreach($needles as $needle){if(!\Inilim\Tool\Method\Str\contains($haystack,$needle,$ignoreCase)){return false;}}return true;}if(!\Inilim\Tool\Str::__definedIfNot('contains')){
    function contains(string $haystack,$needles,bool $ignoreCase=false){if($ignoreCase){$haystack=\mb_strtolower($haystack,'UTF-8');}if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($ignoreCase){$needle=\mb_strtolower($needle,'UTF-8');}if($needle!==''&&\Inilim\Tool\Method\PF\str_contains($haystack,$needle)){return true;}}return false;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80(){return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle){if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}