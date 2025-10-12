<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function intOrFloatOrString($value):bool{return \is_int($value)||\is_float($value)||\is_string($value);}