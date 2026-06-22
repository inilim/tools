<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @param ?\DateTimeZone $timezone default UTC
 */
function msToDtImMut(int $ms, ?\DateTimeZone $timezone = null): \DateTimeImmutable
{
    return \DateTimeImmutable::createFromMutable(
        \Inilim\Tool\Method\Time\msToDt($ms, $timezone)
    );
}
