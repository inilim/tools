<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * 1 month 30 days
 */
function monthsSec(int $months): int
{
    return 2_592_000 * $months;
}
