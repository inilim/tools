<?php

namespace Inilim\Tool\Method\Arr;

function getArrayableItems($items){$type=\gettype($items);if($type==='array'){/**@varmixed[]$items*/return $items;}elseif($type==='object'){/**@varobject$items*/switch(true){case \PHP_VERSION_ID>=80000&&$items instanceof \WeakMap:throw new \InvalidArgumentException('Collections can not be created using instances of WeakMap.');case $items instanceof \Traversable:return \iterator_to_array($items);case $items instanceof \JsonSerializable:return (array) $items -> jsonSerialize();case \PHP_VERSION_ID>=80100&&$items instanceof \UnitEnum:return[$items];case \method_exists($items,'toArray'):return (array) $items -> toArray();case \method_exists($items,'toJson'):return (array) \json_decode($items -> toJson(),true);}}return (array) $items;}