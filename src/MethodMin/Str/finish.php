<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function finish(string $value,string $cap):string{return \preg_replace('/(?:'.\preg_quote($cap,'/').')+$/u','',$value).$cap;}