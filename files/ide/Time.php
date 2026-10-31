<?php

namespace Inilim\Tool;

class Time
{
        /**
 * @link https://php.net/manual/en/function.date.php
 */
    static function date(string $format, ?int $timestamp = null): ?string {
        throw new \Exception;
    }

        /**
 * Format a local time/date
 * analog date('pattern');
 * @link https://php.net/manual/en/function.date.php
 * @todo tests
 * @return string|false
 */
    static function dateMs(string $format, ?int $timestampMs = null) {
        throw new \Exception;
    }

        
    static function daysMs(int $days): int {
        throw new \Exception;
    }

        
    static function daysSec(int $days): int {
        throw new \Exception;
    }

        
    static function hoursToMs(int $hours): int {
        throw new \Exception;
    }

        
    static function hoursToSec(int $hours): int {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @param null|int|\DateInterval $ttl
 */
    static function lifeTime($ttl, int $default = 3600): int {
        throw new \Exception;
    }

        
    static function minToMs(int $min): int {
        throw new \Exception;
    }

        /**
 * @deprecated use Time::minToMs()
 */
    static function minutesToMs(int $min): int {
        throw new \Exception;
    }

        
    static function minutesToSec(int $min): int {
        throw new \Exception;
    }

        /**
 * 1 month 30 days
 */
    static function monthsMs(int $months): int {
        throw new \Exception;
    }

        /**
 * 1 month 30 days
 */
    static function monthsSec(int $months): int {
        throw new \Exception;
    }

        /**
 * @param ?\DateTimeZone $timezone default UTC
 */
    static function msToDt(int $ms, ?\DateTimeZone $timezone = null): DateTime {
        throw new \Exception;
    }

        /**
 * @param ?\DateTimeZone $timezone default UTC
 */
    static function msToDtImMut(int $ms, ?\DateTimeZone $timezone = null): DateTimeImmutable {
        throw new \Exception;
    }

        
    static function msToSec(int $ms): int {
        throw new \Exception;
    }

        /**
 * @param ?\DateTimeZone $timezone default UTC
 */
    static function secToDt(int $sec, ?\DateTimeZone $timezone = null): DateTime {
        throw new \Exception;
    }

        /**
 * @param ?\DateTimeZone $timezone default UTC
 */
    static function secToDtImMut(int $sec, ?\DateTimeZone $timezone = null): DateTimeImmutable {
        throw new \Exception;
    }

        
    static function secToMs(int $seconds): int {
        throw new \Exception;
    }

        /**
 * @deprecated use Time::secToMs()
 */
    static function secondsToMs(int $sec): int {
        throw new \Exception;
    }

        /**
 * @deprecated use Time::sleepMs()
 */
    static function sleepMilSecs(int $v): int {
        throw new \Exception;
    }

        
    static function sleepMs(int $v): int {
        throw new \Exception;
    }

        
    static function sleepRndMilSecs(int $min, int $max): int {
        throw new \Exception;
    }

        
    static function sleepRndSecs(int $min, int $max): int {
        throw new \Exception;
    }

        /**
 * @todo tests
 */
    static function unixMs(): int {
        throw new \Exception;
    }

        /**
 * @todo tests
 */
    static function unixMsFromGlobals(): int {
        throw new \Exception;
    }

        
    static function weeksMs(int $weeks): int {
        throw new \Exception;
    }

        
    static function weeksSec(int $weeks): int {
        throw new \Exception;
    }

    }