<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function numbers($value){return \preg_replace('/[^0-9]/','',$value);}