<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function keysUpper(array $array){return \array_change_key_case($array,\CASE_UPPER);}