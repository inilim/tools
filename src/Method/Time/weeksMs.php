<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function weeksMs(int $weeks): int
{
    return \Inilim\Tool\Method\Time\weeksSec($weeks) * 1000;
}
