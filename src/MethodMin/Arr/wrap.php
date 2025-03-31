<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function wrap($value):array{return \is_array($value)?$value:[$value];}