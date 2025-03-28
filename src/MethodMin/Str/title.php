<?php

namespace Inilim\Tool\Method\Str;

function title(string $value):string{return \mb_convert_case($value,\MB_CASE_TITLE,'UTF-8');}