<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function validArrayKey($value):bool{return \is_int($value)||\is_string($value);}