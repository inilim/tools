<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function ltrim($value,$charlist=null){if($charlist===null){$ltrimDefaultCharacters=" \n\r\t\v\x00";return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$ltrimDefaultCharacters.']+~u','',$value)?? \ltrim($value);}return \ltrim($value,$charlist);}