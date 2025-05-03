<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function length(string $value,$encoding='UTF-8'):int{return \mb_strlen($value,$encoding);}