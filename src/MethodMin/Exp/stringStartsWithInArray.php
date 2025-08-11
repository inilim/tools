<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp{function stringStartsWithInArray(array $array,string $needle,bool $ignoreCase=false):bool{foreach($array as $string){if($ignoreCase){if(\Inilim\Tool\Method\Str\iStartsWithOnce($string,$needle)){return true;}}elseif(\Inilim\Tool\Method\PF\str_starts_with($string,$needle)){return true;}}return false;}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('iStartsWithOnce')){
    function iStartsWithOnce(string $haystack,string $needle):bool{return ''===$needle||\mb_stripos($haystack,$needle,0,'UTF-8')===0;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}