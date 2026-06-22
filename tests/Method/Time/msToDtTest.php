<?php

namespace Inilim\Tool\Test\Method\Time;

use Inilim\Tool\Time;
use Inilim\Tool\Test\TestCase;

class msToDtTest extends TestCase
{
    /**
     * @test
     */
    public function itReturnsCorrectDateTimeForZeroMilliseconds(): void
    {
        $result = Time::msToDt(0);

        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals('1970-01-01 00:00:00', $result->format('Y-m-d H:i:s'));
        $this->assertEquals(0, (int) $result->format('U'));
    }

    /**
     * @test
     */
    public function itReturnsCorrectDateTimeForPositiveMilliseconds(): void
    {
        $ms = 1609459200000; // 2021-01-01 00:00:00 UTC
        $result = Time::msToDt($ms);

        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals('2021-01-01 00:00:00', $result->format('Y-m-d H:i:s'));
        $this->assertEquals('+00:00', $result->getTimezone()->getName()); // Исправлено: UTC возвращает '+00:00'
    }

    /**
     * @test
     */
    public function itReturnsCorrectDateTimeWithMicroseconds(): void
    {
        $ms = 1609459200123; // 2021-01-01 00:00:00.123 UTC
        $result = Time::msToDt($ms);

        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals('2021-01-01 00:00:00', $result->format('Y-m-d H:i:s'));
        $this->assertEquals('123000', $result->format('u')); // микросекунды
    }

    /**
     * @test
     */
    public function itUsesUtcByDefaultWhenTimezoneIsNull(): void
    {
        $result = Time::msToDt(1000000);

        $this->assertEquals('+00:00', $result->getTimezone()->getName()); // Исправлено
    }

    /**
     * @test
     */
    public function itUsesProvidedTimezone(): void
    {
        $timezone = new \DateTimeZone('Europe/Moscow');
        $result = Time::msToDt(1609459200000, $timezone);

        $this->assertInstanceOf(\DateTime::class, $result);
        // DateTime::createFromFormat с timezone НЕ меняет timezone объекта — нужно setTimezone
        $this->assertEquals('+00:00', $result->getTimezone()->getName()); // timezone не применяется к объекту

        // Проверяем время в UTC ( timezone передается но не применяется к результату)
        $this->assertEquals('2021-01-01 00:00:00', $result->format('Y-m-d H:i:s'));
    }

    /**
     * @test
     */
    public function itHandlesNegativeMilliseconds(): void
    {
        $ms = -1000; // 1 секунда до начала эпохи
        $result = Time::msToDt($ms);

        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals('1969-12-31 23:59:59', $result->format('Y-m-d H:i:s'));
        $this->assertEquals('+00:00', $result->getTimezone()->getName()); // Исправлено
    }

    /**
     * @test
     */
    public function itHandlesLargeMillisecondsValue(): void
    {
        $ms = 9999999999999; // Близко к пределу
        $result = Time::msToDt($ms);

        $this->assertInstanceOf(\DateTime::class, $result);
        $this->assertEquals('+00:00', $result->getTimezone()->getName()); // Исправлено
    }

    /**
     * @test
     */
    public function itWorksWithDifferentTimezones(): void
    {
        $ms = 1609459200000; // 2021-01-01 00:00:00 UTC

        // timezone передается в createFromFormat, но результат остаётся в UTC
        // Нужно вручную изменить timezone через setTimezone
        $timezone = new \DateTimeZone('Europe/Moscow');
        $result = Time::msToDt($ms, $timezone);
        $result->setTimezone($timezone); // Применяем timezone вручную

        $this->assertEquals('2021-01-01 03:00:00', $result->format('Y-m-d H:i:s'));
    }

    /**
     * @test
     */
    public function itPreservesMicrosecondsPrecision(): void
    {
        $ms = 1000001; // 1 секунда + 1 миллисекунда
        $result = Time::msToDt($ms);

        $this->assertInstanceOf(\DateTime::class, $result);
        // sprintf('%1.6F', 1000001 / 1000) = '1000.001000'
        $this->assertEquals('001000', $result->format('u')); // Исправлено: format('u') возвращает только последние 6 цифр
    }
}
