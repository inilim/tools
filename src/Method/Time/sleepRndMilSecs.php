<?php

namespace Inilim\Tool\Method\Time;

/**
 * @return void
 */
function sleepRndMilSecs(int $min, int $max)
{
    \Inilim\Tool\Method\Time\sleepMilSecs(\mt_rand($min, $max));
}
