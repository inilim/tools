<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function replaceStart(string $search,string $replace,string $subject):string{if($search===''){return $subject;}if(\Inilim\Tool\Method\Str\startsWith($subject,$search)){return \Inilim\Tool\Method\Str\replaceFirst($search,$replace,$subject);}return $subject;}if(!\Inilim\Tool\Str::__definedIfNot('_startsWith')){
    function _startsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }if(!\Inilim\Tool\Str::__definedIfNot('replaceFirst')){
    function replaceFirst(string $search,string $replace,string $subject):string{if($search===''){return $subject;}$position=\strpos($subject,$search);if($position!==false){return \substr_replace($subject,$replace,$position,\strlen($search));}return $subject;}
    }if(!\Inilim\Tool\Str::__definedIfNot('startsWith')){
    function startsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\Str\_startsWith($haystack,$needle)){return true;}}return false;}
    }}