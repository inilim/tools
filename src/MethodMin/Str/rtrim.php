<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function rtrim(string $value,?string $charlist=null){if($charlist===null){$rtrimDefaultCharacters=\preg_quote(" \n\r\t\v\x00");return \preg_replace('~[\s\x{FEFF}\x{200B}\x{200E}'.$rtrimDefaultCharacters.']+$~u','',$value)?? \rtrim($value);}return \rtrim($value,$charlist);}