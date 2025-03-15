<?php

namespace Inilim\Tool\Method\String;

/**
 * Convert a value to camel case.
 */
function camel(string $value): string
{
    return \lcfirst(\Inilim\Tool\Method\String\studly($value));
}
