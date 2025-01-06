<?php

namespace Inilim\Method\Arr;

function keysLower(array $array): array
{
    return \array_change_key_case($array, \CASE_LOWER);
}
