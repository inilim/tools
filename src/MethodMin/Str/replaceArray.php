<?php

namespace Inilim\Tool\Method\Str{function replaceArray(string $search,$replace,string $subject){$replace=\Inilim\Tool\Method\LarArr\from($replace);$segments=\explode($search,$subject);$result=\array_shift($segments);foreach($segments as $segment){$result .= \Inilim\Tool\Method\Str\toStringOr(\array_shift($replace)?? $search,$search).$segment;}return $result;}if(!\Inilim\Tool\Str::__definedIfNot('toStringOr')){
    function toStringOr($value,string $fallback):string{try{return (string) $value;}catch(\Throwable $e){return $fallback;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('from')){
    function from($items){$type=\gettype($items);if($type==='array'){return $items;}elseif($type==='object'){if(false){}elseif(\method_exists($items,'toArray')){return $items -> toArray();}elseif(\method_exists($items,'toJson')){return (array) \json_decode($items -> toJson(),true);}elseif(\Inilim\Tool\Method\Check\php80()&&$items instanceof \WeakMap){return \iterator_to_array($items,false);}elseif($items instanceof \Traversable){return \iterator_to_array($items);}elseif($items instanceof \JsonSerializable){return (array) $items -> jsonSerialize();}else{return (array) $items;}}throw new \InvalidArgumentException('Items cannot be represented by a scalar value.');}
    }}