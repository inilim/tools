<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function countable($value):bool{if(\is_array($value)||$value instanceof \Countable){return true;}return false;}