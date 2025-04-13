<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function trim(string $value,?string $charlist=null){if($charlist===null){$trimDefaultCharacters=" \n\r\t\v\x00";return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+|[\s\x{FEFF}\x{200B}\x{200E}'.$trimDefaultCharacters.']+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}