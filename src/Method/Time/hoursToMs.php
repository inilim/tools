<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function hoursToMs(int $hours): int
{
    return 3_600_000 * $hours;
}
