<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function httpHeaderValue($value):bool{return \is_string($value)&&(bool) \preg_match('/^[\x20\x09\x21-\x7E\x80-\xFF]*$/D',$value);}