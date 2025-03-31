<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function replaceArray(string $search,array $replace,string $subject):string{$segments=\explode($search,$subject);$result=\array_shift($segments);foreach($segments as $segment){$result .= \Inilim\Tool\Method\Str\toStringOr(\array_shift($replace)?? $search,$search).$segment;}return $result;}if(!\Inilim\Tool\Str::__definedIfNot('toStringOr')){
    function toStringOr($value,string $fallback){try{return (string) $value;}catch(\Throwable $e){return $fallback;}}
    }}