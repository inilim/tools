<?php

namespace Inilim\Tool;

class Time
{
        /**
 * @link https://php.net/manual/en/function.date.php
 */
    static function date(string $format, ?int $timestamp = null): ?string {}

        /**
 * Format a local time/date
 * analog date('pattern');
 * @link https://php.net/manual/en/function.date.php
 * @todo tests
 * @return string|false
 */
    static function dateMs(string $format, ?int $timestampMs = null) {}

        
    static function daysMs(int $days): int {}

        
    static function daysSec(int $days): int {}

        
    static function hoursToMs(int $hours): int {}

        
    static function hoursToSec(int $hours): int {}

        /**
 * @todo tests
 * @param null|int|\DateInterval $ttl
 */
    static function lifeTime($ttl, int $default = 3600): int {}

        
    static function minutesToMs(int $min): int {}

        
    static function minutesToSec(int $min): int {}

        /**
 * 1 month 30 days
 */
    static function monthsMs(int $months): int {}

        /**
 * 1 month 30 days
 */
    static function monthsSec(int $months): int {}

        
    static function msToSec(int $ms): int {}

        
    static function secToMs(int $seconds): int {}

        
    static function secondsToMs(int $sec): int {}

        /**
 * @deprecated use Time::sleepMs()
 */
    static function sleepMilSecs(int $v): int {}

        
    static function sleepMs(int $v): int {}

        
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

        
    static function weeksMs(int $weeks): int {}

        
    static function weeksSec(int $weeks): int {}

    }