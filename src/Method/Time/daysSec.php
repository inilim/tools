<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function daysSec(int $days): int
{
    return 86_400 * $days;
}
