<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function convertCase(string $string,int $mode=\MB_CASE_FOLD,?string $encoding='UTF-8'){return \mb_convert_case($string,$mode,$encoding);}