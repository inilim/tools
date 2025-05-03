<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function isMatch($pattern,string $value):bool{if(!\is_iterable($pattern)){$pattern=[$pattern];}foreach($pattern as $pattern){if(\preg_match((string) $pattern,$value)===1){return true;}}return false;}