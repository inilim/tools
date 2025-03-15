<?php

namespace Inilim\Tool\Method\Time;

/**
 * @return void
 */
function sleepRndSecs(int $min, int $max)
{
    \sleep(\mt_rand($min, $max));
}
