<?php

declare(strict_types=1);namespace Inilim\Tool\Method\LarStr{function start($value,$prefix){if($prefix===''){return $value;}if(!\Inilim\Tool\Method\PF\str_starts_with($value,$prefix)){return $prefix.$value;}if(!\Inilim\Tool\Method\PF\str_starts_with($value,$prefix.$prefix)){return $value;}$quoted=\preg_quote($prefix,'/');return $prefix.\preg_replace('/^(?:'.$quoted.')+/u','',$value);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}