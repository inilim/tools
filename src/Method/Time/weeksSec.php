<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function weeksSec(int $weeks): int
{
    return 604_800 * $weeks;
}
