<?php

namespace Inilim\Tool\Method\Str;

function reverse(string $value):string{return \implode(\array_reverse(\mb_str_split($value)));}