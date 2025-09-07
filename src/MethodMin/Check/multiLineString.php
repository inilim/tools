<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function multiLineString($value):bool{return \is_string($value)&&\preg_match("#\r\n?| | #",$value)===1;}