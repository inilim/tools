<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function arrLike($value):bool{if(\is_object($value)&&$value instanceof \Traversable&&$value instanceof \Countable&&$value instanceof \ArrayAccess){return true;}return false;}