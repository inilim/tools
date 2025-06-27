<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function hoursToSec(int $hours): int
{
    return 3_600 * $hours;
}
