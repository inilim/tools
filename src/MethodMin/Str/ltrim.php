<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function ltrim(string $value,?string $charlist=null){if($charlist===null){$ltrimDefaultCharacters=\preg_quote(" \n\r\t\v\x00");return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$ltrimDefaultCharacters.']+~u','',$value)?? \ltrim($value);}return \ltrim($value,$charlist);}