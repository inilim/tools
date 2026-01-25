<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function uuidv7($value):bool{return \is_string($value)&&(bool) \preg_match('/^[0-9a-f]{8}(?:\-[0-9a-f]{4}){3}-[0-9a-f]{12}$/',$value);}