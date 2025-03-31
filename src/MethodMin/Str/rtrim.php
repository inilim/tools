<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function rtrim($value,$charlist=null){if($charlist===null){return \preg_replace('~[\s\x{FEFF}\x{200B}\x{200E}]+$~u','',$value)?? \rtrim($value);}return \rtrim($value,$charlist);}