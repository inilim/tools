<?php

namespace Inilim\Tool\Method\Arr;

function keysUpper(array $array): array
{
    return \array_change_key_case($array, \CASE_UPPER);
}
