<?php

namespace Inilim\Tool;

class Time
{
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