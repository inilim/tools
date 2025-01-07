<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('studly');

/**
 * Convert a value to camel case.
 */
function camel(string $value): string
{
    return \lcfirst(studly($value));
}
