<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function rtrim($value,$charlist=null){if($charlist===null){$rtrimDefaultCharacters=" \n\r\t\v\x00";return \preg_replace('~[\s\x{FEFF}\x{200B}\x{200E}'.$rtrimDefaultCharacters.']+$~u','',$value)?? \rtrim($value);}return \rtrim($value,$charlist);}