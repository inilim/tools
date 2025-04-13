<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function toArray(string $string,array $separators=[',','-','|',';',':','/','\\']){if($string===''){return[];}$result=[$string];foreach($separators as $separator){if(\Inilim\Tool\Method\Str\_contains($string,$separator)){$result=\explode($separator,$string);break;}}return $result;}if(!\Inilim\Tool\Str::__definedIfNot('_contains')){
    function _contains(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_contains($haystack,$needle);}return ''===$needle||false!==strpos($haystack,$needle);}
    }}