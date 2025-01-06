<?php

namespace Inilim\Tool\Method\String;

use Inilim\Tool\Str;

// \Inilim\Tool\Method\String\

Str::__include([
    'random',
    '__state',
    'createRandomStringsUsing',
]);

/**
 * Set the sequence that will be used to generate random strings.
 * @return void
 */
function createRandomStringsUsingSequence(array $sequence, ?callable $when_missing = null)
{
    $next = 0;

    $when_missing ??= static function ($length) use (&$next) {
        $state = \Inilim\Tool\Method\String\__state();

        $factory_cache = $state->randomStringFactory;

        $state->randomStringFactory = null;

        $random_string = \Inilim\Tool\Method\String\random($length);

        $state->randomStringFactory = $factory_cache;

        $next++;

        return $random_string;
    };

    \Inilim\Tool\Method\String\createRandomStringsUsing(static function ($length) use (&$next, $sequence, $when_missing) {
        if (\array_key_exists($next, $sequence)) {
            return $sequence[$next++];
        }

        return $when_missing($length);
    });
}
