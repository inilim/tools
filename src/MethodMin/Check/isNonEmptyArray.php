<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function isNonEmptyArray($value):bool{return \is_array($value)&&!!$value;}