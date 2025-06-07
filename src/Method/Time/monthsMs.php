<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * 1 month 30 days
 */
function monthsMs(int $months): int
{
    return \Inilim\Tool\Method\Time\monthsSec($months) * 1000;
}
