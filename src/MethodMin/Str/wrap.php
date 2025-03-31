<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function wrap(string $value,string $before,?string $after=null):string{return $before.$value.$after ??= $before;}