<?php

namespace Inilim\Tool;

class Time
{
        /**
 * @todo tests
 * @param null|int|\DateInterval $ttl
 */
    static function lifeTime($ttl, int $default = 3600): int {}

        /**
 * @return void
 */
    static function sleepMilSecs(int $v) {}

        /**
 * @return void
 */
    static function sleepRndMilSecs(int $min, int $max) {}

        /**
 * @return void
 */
    static function sleepRndSecs(int $min, int $max) {}

        /**
 * @todo tests
 * @return int
 */
    static function unixMs() {}

    }