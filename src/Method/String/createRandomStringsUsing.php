<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('__state');

/**
 * Set the callable that will be used to generate random strings.
 */
function createRandomStringsUsing(?callable $factory = null): void
{
    __state()->randomStringFactory = $factory;
}
