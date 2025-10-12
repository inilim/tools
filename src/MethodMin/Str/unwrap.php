<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str{function unwrap(string $value,string $before,?string $after=null):string{if(\Inilim\Tool\Method\Str\startsWith($value,$before)){$value=\Inilim\Tool\Method\Str\substr($value,\Inilim\Tool\Method\Str\length($before));}if(\Inilim\Tool\Method\Str\endsWith($value,$after ??= $before)){$value=\Inilim\Tool\Method\Str\substr($value,0,-\Inilim\Tool\Method\Str\length($after));}return $value;}if(!\Inilim\Tool\Str::__definedIfNot('endsWith')){
    function endsWith(string $haystack,$needles,bool $ignoreCase=false):bool{if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''){if($ignoreCase){if(\Inilim\Tool\Method\Str\iEndsWithOnce($haystack,$needle)){return true;}}elseif(\Inilim\Tool\Method\PF\str_ends_with($haystack,$needle)){return true;}}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('iEndsWithOnce')){
    function iEndsWithOnce(string $haystack,string $needle):bool{return ''===$needle||\mb_stripos($haystack,$needle,-\mb_strlen($needle,'UTF-8'),'UTF-8')!==false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('iStartsWithOnce')){
    function iStartsWithOnce(string $haystack,string $needle):bool{return ''===$needle||\mb_stripos($haystack,$needle,0,'UTF-8')===0;}
    }if(!\Inilim\Tool\Str::__definedIfNot('length')){
    function length(string $value,$encoding='UTF-8'):int{return \mb_strlen($value,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('startsWith')){
    function startsWith(string $haystack,$needles,bool $ignoreCase=false):bool{if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''){if($ignoreCase){if(\Inilim\Tool\Method\Str\iStartsWithOnce($haystack,$needle)){return true;}}elseif(\Inilim\Tool\Method\PF\str_starts_with($haystack,$needle)){return true;}}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_ends_with')){
    function str_ends_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_ends_with($haystack,$needle);}if(''===$needle||$needle===$haystack){return true;}if(''===$haystack){return false;}$needleLength=\strlen($needle);return $needleLength<=\strlen($haystack)&&0===\substr_compare($haystack,$needle,-$needleLength);}
    }if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}