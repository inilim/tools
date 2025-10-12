<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Time;

function sleepMilSecs(int $v):int{$t=1000*$v;\usleep($t);return $v;}