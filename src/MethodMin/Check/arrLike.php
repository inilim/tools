<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function arrLike($value):bool{if(!\is_object($value)){return false;}if($value instanceof \IteratorAggregate&&$value instanceof \Countable&&$value instanceof \ArrayAccess){return true;}return false;}