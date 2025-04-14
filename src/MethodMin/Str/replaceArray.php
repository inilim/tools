<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function replaceArray(string $search,$replace,string $subject){$replace=\Inilim\Tool\Method\Obj\toArrayIfTraversable($replace);$segments=\explode($search,$subject);$result=\array_shift($segments);foreach($segments as $segment){$result .= \Inilim\Tool\Method\Str\toStringOr(\array_shift($replace)?? $search,$search).$segment;}return $result;}if(!\Inilim\Tool\Str::__definedIfNot('toStringOr')){
    function toStringOr($value,string $fallback){try{return (string) $value;}catch(\Throwable $e){return $fallback;}}
    }}namespace Inilim\Tool\Method\Obj{if(!\Inilim\Tool\Obj::__definedIfNot('toArrayIfTraversable')){
    function toArrayIfTraversable($value){if($value instanceof \Traversable){return \iterator_to_array($value);}return $value;}
    }}