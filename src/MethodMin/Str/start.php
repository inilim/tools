<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function start(string $value,string $prefix):string{$quoted=\preg_quote($prefix,'/');return $prefix.\preg_replace('/^(?:'.$quoted.')+/u','',$value);}