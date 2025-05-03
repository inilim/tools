<?php

namespace Inilim\Tool\Method\Time;

/**
 * @todo tests
 * @param null|int|\DateInterval $ttl
 */
function lifeTime($ttl, int $default = 3600): int
{
    if ($ttl === null) {
        return $default;
    } elseif (\is_int($ttl)) {
        return $ttl;
    }
    return (new \DateTime)->add($ttl)->getTimestamp() - \time();
}
