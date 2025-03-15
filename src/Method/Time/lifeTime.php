<?php

namespace Inilim\Tool\Method\Time;

/**
 * @param null|int|\DateInterval $ttl
 * @return int
 */
function lifeTime($ttl, int $default = 3600)
{
    if ($ttl === null) {
        return $default;
    } elseif (\is_int($ttl)) {
        return $ttl;
    }
    return (new \DateTime)->add($ttl)->getTimestamp() - \time();
}
