<?php

namespace Inilim\Tool\Method\LarArr;

function arrayable($value){$type=\gettype($value);if($type==='array'){return true;}elseif($type==='object'){return $value instanceof \Traversable||$value instanceof \JsonSerializable||\method_exists($value,'toArray')||\method_exists($value,'toJson');}return false;}