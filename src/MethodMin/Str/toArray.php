<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str{function toArray(string $string,array $separators=[',','-','|',';',':','/','\\']):array{if($string===''){return[];}$result=[$string];foreach($separators as $separator){if(\Inilim\Tool\Method\PF\str_contains($string,$separator)){$result=\explode($separator,$string);break;}}return $result;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}