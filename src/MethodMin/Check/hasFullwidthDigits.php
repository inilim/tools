<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function hasFullwidthDigits($value):bool{return \is_string($value)&&\preg_match('/[\x{FF10}-\x{FF19}]/u',$value)===1;}