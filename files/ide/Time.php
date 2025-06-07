<?php

namespace Inilim\Tool;

class Time
{
        /**
 * Format a local time/date
 * @todo tests
 * @return string|false
 */
    static function dateMs(string $format, ?int $timestampMs = null) {}

        /**
 * @todo tests
 * @param null|int|\DateInterval $ttl
 */
    static function lifeTime($ttl, int $default = 3600): int {}

        
    static function sleepMilSecs(int $v): int {}

        
    static function sleepRndMilSecs(int $min, int $max): int {}

        
    static function sleepRndSecs(int $min, int $max): int {}

        /**
 * @todo tests
 */
    static function unixMs(): int {}

        /**
 * @todo tests
 */
    static function unixMsFromGlobals(): int {}

    }