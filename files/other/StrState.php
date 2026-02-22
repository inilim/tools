<?php

namespace Inilim\Internal;

/**
 * @internal Inilim\Tool\Method\Str
 */
class StrState
{
    const INVISIBLE_CHARACTERS = '';

    /**
     * The callback that should be used to generate random strings.
     * @var callable|null
     */
    var $randomStringFactory;
}
