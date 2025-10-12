<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function intOrFloat($value):bool{return \is_int($value)||\is_float($value);}