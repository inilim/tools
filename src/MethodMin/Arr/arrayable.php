<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function arrayable($value):bool{$type=\gettype($value);if($type==='array'){return true;}elseif($type==='object'){return $value instanceof \Traversable||$value instanceof \JsonSerializable||\method_exists($value,'toArray')||\method_exists($value,'toJson');}return false;}