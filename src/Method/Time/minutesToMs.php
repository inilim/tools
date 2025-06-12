<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function minutesToMs(int $min): int
{
    return 60_000 * $min;
}
