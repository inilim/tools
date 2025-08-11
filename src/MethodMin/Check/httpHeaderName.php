<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function httpHeaderName($value):bool{return \is_string($value)&&(bool) \preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/D',$value);}