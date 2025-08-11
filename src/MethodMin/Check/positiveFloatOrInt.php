<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function positiveFloatOrInt($value):bool{return(\is_int($value)||\is_float($value))&&$value>0;}