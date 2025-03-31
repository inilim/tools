<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function ltrim($value,$charlist=null){if($charlist===null){return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}]+~u','',$value)?? \ltrim($value);}return \ltrim($value,$charlist);}