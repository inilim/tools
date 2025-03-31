<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function reverse(string $value):string{return \implode(\array_reverse(\mb_str_split($value)));}