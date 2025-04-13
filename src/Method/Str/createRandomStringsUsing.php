<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Set the callable that will be used to generate random strings.
 * @return void
 */
function createRandomStringsUsing(?callable $factory = null)
{
    \Inilim\Tool\Method\Str\__state()->randomStringFactory = $factory;
}
