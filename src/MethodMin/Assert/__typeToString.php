<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert;

function __typeToString($value):string{return \is_object($value)?\get_class($value):\gettype($value);}