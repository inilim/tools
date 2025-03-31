<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function numbers(string $value):string{return \preg_replace('/[^0-9]/','',$value);}