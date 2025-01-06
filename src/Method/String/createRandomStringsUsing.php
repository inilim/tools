<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

// \Inilim\Method\String\

Str::__include('__state');

/**
 * Set the callable that will be used to generate random strings.
 */
function createRandomStringsUsing(?callable $factory = null): void
{
    \Inilim\Method\String\__state()->randomStringFactory = $factory;
}
