<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Set the sequence that will be used to generate random strings.
 * @return void
 */
function createRandomStringsUsingSequence(array $sequence, ?callable $whenMissing = null)
{
    $next = 0;

    $whenMissing ??= static function ($length) use (&$next) {
        $state = \Inilim\Tool\Method\Str\__state();

        $factory_cache = $state->randomStringFactory;

        $state->randomStringFactory = null;

        $randomString = \Inilim\Tool\Method\Str\random($length);

        $state->randomStringFactory = $factory_cache;

        $next++;

        return $randomString;
    };

    \Inilim\Tool\Method\Str\createRandomStringsUsing(static function ($length) use (&$next, $sequence, $whenMissing) {
        if (\array_key_exists($next, $sequence)) {
            return $sequence[$next++];
        }

        return $whenMissing($length);
    });
}
