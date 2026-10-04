<?php

declare(strict_types=1);namespace Inilim\Tool\Method\LarStr{function contains($haystack,$needles,$ignoreCase=false){if(\is_null($haystack)){return false;}if($ignoreCase){$haystack=\mb_strtolower($haystack);}if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($ignoreCase){$needle=\mb_strtolower($needle);}if($needle!==''&&\Inilim\Tool\Method\PF\str_contains($haystack,$needle)){return true;}}return false;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}