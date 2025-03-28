<?php

namespace Inilim\Tool\Method\Str;

/**
 * Set the sequence that will be used to generate random strings.
 * @return void
 */
function createRandomStringsUsingSequence(array $sequence, ?callable $when_missing = null)
{
    $next = 0;

    $when_missing ??= static function ($length) use (&$next) {
        $state = \Inilim\Tool\Method\Str\__state();

        $factory_cache = $state->randomStringFactory;

        $state->randomStringFactory = null;

        $random_string = \Inilim\Tool\Method\Str\random($length);

        $state->randomStringFactory = $factory_cache;

        $next++;

        return $random_string;
    };

    \Inilim\Tool\Method\Str\createRandomStringsUsing(static function ($length) use (&$next, $sequence, $when_missing) {
        if (\array_key_exists($next, $sequence)) {
            return $sequence[$next++];
        }

        return $when_missing($length);
    });
}
