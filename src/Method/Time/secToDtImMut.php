<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @param ?\DateTimeZone $timezone default UTC
 */
function secToDtImMut(int $sec, ?\DateTimeZone $timezone = null): \DateTimeImmutable
{
    return \DateTimeImmutable::createFromMutable(
        \Inilim\Tool\Method\Time\secToDt($sec, $timezone)
    );
}
