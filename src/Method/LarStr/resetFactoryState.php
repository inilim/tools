<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Return all factory functions to their default state.
 *
 * @return void
 * 
 * @build_skip
 */
function resetFactoryState()
{
    static::createRandomStringsNormally();
    static::createUlidsNormally();
    static::createUuidsNormally();
}
