<?php

namespace Inilim\Tool\Method\LarStr{function replaceArray($search,$replace,$subject){if($replace instanceof \Traversable){$replace=\iterator_to_array($replace);}$segments=\explode($search,$subject);$result=\array_shift($segments);foreach($segments as $segment){$result .= \Inilim\Tool\Method\LarStr\toStringOr(\array_shift($replace)?? $search,$search).$segment;}return $result;}if(!\Inilim\Tool\LarStr::__definedIfNot('toStringOr')){
    function toStringOr($value,$fallback){try{return (string) $value;}catch(\Throwable $e){return $fallback;}}
    }}