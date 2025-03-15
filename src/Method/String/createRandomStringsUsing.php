<?php

namespace Inilim\Tool\Method\String;

/**
 * Set the callable that will be used to generate random strings.
 * @return void
 */
function createRandomStringsUsing(?callable $factory = null)
{
    \Inilim\Tool\Method\String\__state()->randomStringFactory = $factory;
}
