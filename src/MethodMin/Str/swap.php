<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function swap(array $map,string $subject):string{return \strtr($subject,$map);}