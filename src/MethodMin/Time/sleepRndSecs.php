<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function sleepRndSecs(int $min,int $max):int{$t=\mt_rand($min,$max);\sleep($t);return $t;}