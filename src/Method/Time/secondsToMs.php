<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @deprecated use Time::secToMs()
 */
function secondsToMs(int $sec): int
{
    return 1_000 * $sec;
}
