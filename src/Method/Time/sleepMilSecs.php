<?php

namespace Inilim\Tool\Method\Time;

/**
 * @return void
 */
function sleepMilSecs(int $v)
{
    \usleep((1000 * $v));
}
