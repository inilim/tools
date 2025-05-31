<?php

namespace Inilim\Tool\Method\Time;

function sleepMilSecs(int $v): int
{
    $t = 1000 * $v;
    \usleep($t);
    return $t;
}
