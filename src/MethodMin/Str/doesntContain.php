<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function doesntContain(string $haystack,$needles,bool $ignoreCase=false):bool{return!\Inilim\Tool\Method\Str\contains($haystack,$needles,$ignoreCase);}if(!\Inilim\Tool\Str::__definedIfNot('contains')){
    function contains(string $haystack,$needles,bool $ignoreCase=false):bool{if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($needle!==''){if($ignoreCase){if(\Inilim\Tool\Method\Str\iContainsOnce($haystack,$needle)){return true;}}elseif(\Inilim\Tool\Method\PF\str_contains($haystack,$needle)){return true;}}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('iContainsOnce')){
    function iContainsOnce(string $haystack,string $needle):bool{return ''===$needle||\mb_stripos($haystack,$needle,0,'UTF-8')!==false;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}