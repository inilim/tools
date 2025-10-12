<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function keysLower(array $array){return \array_change_key_case($array,\CASE_LOWER);}