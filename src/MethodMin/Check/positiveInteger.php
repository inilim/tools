<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function positiveInteger($value):bool{return \is_int($value)&&$value>0;}