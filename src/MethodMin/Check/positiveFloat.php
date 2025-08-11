<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function positiveFloat($value):bool{return \is_float($value)&&$value>0;}