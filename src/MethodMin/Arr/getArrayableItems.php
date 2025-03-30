<?php

namespace Inilim\Tool\Method\Arr;

function getArrayableItems($items){if(\is_array($items)){return $items;}switch(true){case \PHP_VERSION_ID>=80000&&$items instanceof \WeakMap:throw new \InvalidArgumentException('Collections can not be created using instances of WeakMap.');case $items instanceof \Traversable:return \iterator_to_array($items);case $items instanceof \JsonSerializable:return (array) $items -> jsonSerialize();case \PHP_VERSION_ID>=80100&&$items instanceof \UnitEnum:return[$items];}return (array) $items;}