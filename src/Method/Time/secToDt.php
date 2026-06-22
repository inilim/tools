<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @param ?\DateTimeZone $timezone default UTC
 */
function secToDt(int $sec, ?\DateTimeZone $timezone = null): \DateTime
{
    return new \DateTime("@$sec", $timezone ?? new \DateTimeZone('UTC'));
}
