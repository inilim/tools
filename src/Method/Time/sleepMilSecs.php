<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @deprecated use Time::sleepMs()
 */
function sleepMilSecs(int $v): int
{
    return \Inilim\Tool\Method\Time\sleepMs($v);
}
