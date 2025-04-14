<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

function formatByPattern(string $string,string $pattern){if(\strlen($string)!==\substr_count($pattern,'*')){throw new \InvalidArgumentException('Number of placeholders must be the same as the length of the input string');}$res='';$index=0;for($i=0;$i<\strlen($pattern);$i++){$res .= $pattern[$i]==='*'?$string[$index++]:$pattern[$i];}return $res;}