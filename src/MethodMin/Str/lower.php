<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}