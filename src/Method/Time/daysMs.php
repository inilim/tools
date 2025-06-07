<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function daysMs(int $days): int
{
    return \Inilim\Tool\Method\Time\daysSec($days) * 1000;
}
