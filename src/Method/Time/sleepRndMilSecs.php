<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function sleepRndMilSecs(int $min, int $max): int
{
    return \Inilim\Tool\Method\Time\sleepMilSecs(\mt_rand($min, $max));
}
