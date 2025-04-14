<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function matchAll(string $pattern,string $subject){\preg_match_all($pattern,$subject,$matches);if(empty($matches[0])){return[];}return $matches[1]?? $matches[0];}