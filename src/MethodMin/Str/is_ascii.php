<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function is_ascii(string $str):bool{if($str===''){return true;}return!\preg_match('/'."[^\t\x10\x13\n\r -~]".'/',$str);}