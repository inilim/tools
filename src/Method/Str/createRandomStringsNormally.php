<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Indicate that random strings should be created normally and not using a custom factory.
 * @return void
 */
function createRandomStringsNormally()
{
    \Inilim\Tool\Method\Str\__state()->randomStringFactory = null;
}
