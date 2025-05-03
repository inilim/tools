<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function replaceStart(string $search,string $replace,string $subject){if($search===''){return $subject;}if(\Inilim\Tool\Method\Str\startsWith($subject,$search)){return \Inilim\Tool\Method\Str\replaceFirst($search,$replace,$subject);}return $subject;}if(!\Inilim\Tool\Str::__definedIfNot('replaceFirst')){
    function replaceFirst(string $search,string $replace,string $subject){if($search===''){return $subject;}$position=\strpos($subject,$search);if($position!==false){return \substr_replace($subject,$replace,$position,\strlen($search));}return $subject;}
    }if(!\Inilim\Tool\Str::__definedIfNot('startsWith')){
    function startsWith(string $haystack,$needles):bool{if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\PF\str_starts_with($haystack,$needle)){return true;}}return false;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}