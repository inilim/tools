<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}