<?php

declare(strict_types=1);

use Inilim\Tool\Other;

final class exceptionallyTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @withoutErrorHandler
     * @dataProvider data1
     */
    function testItThrowsErrors(int $level): void
    {
        $this->expectException(\ErrorException::class);

        try {
            Other::exceptionally(static function () use ($level): void {
                trigger_error('Message', $level);
            });
        } catch (\ErrorException $exception) {
            self::assertSame('Message', $exception->getMessage());
            self::assertSame(0, $exception->getCode());
            self::assertSame(__LINE__ - 5, $exception->getLine());
            self::assertSame(__FILE__, $exception->getFile());
            self::assertSame($level, $exception->getSeverity());
            self::assertNull($exception->getPrevious());

            throw $exception;
        }
    }

    static function data1()
    {
        return [
            [E_USER_NOTICE],
            [E_USER_WARNING],
            [E_USER_ERROR],
        ];
    }

    /**
     * @withoutErrorHandler
     * @doesNotPerformAssertions
     */
    function testItDoesNotThrowDeprecationsByDefault(): void
    {
        Other::exceptionally(static function (): void {
            trigger_error('Message', E_USER_DEPRECATED);
        });
    }

    /**
     * @withoutErrorHandler
     */
    function testItThrowsDeprecationIfConfiguredExplicitly(): void
    {
        $this->expectException(\ErrorException::class);

        Other::exceptionally(static function (): void {
            trigger_error('Message', E_USER_DEPRECATED);
        }, E_USER_DEPRECATED);
    }

    /**
     * @withoutErrorHandler
     */
    function testItThrowsNoMatterWhatErrorReportingLevel(): void
    {
        $this->expectException(\ErrorException::class);

        Other::exceptionally(static function (): void {
            trigger_error('Message', E_USER_WARNING);
        });
    }

    /**
     * @withoutErrorHandler
     * @doesNotPerformAssertions
     */
    function testItIgnoresErrorLevelsOutsideConfigured(): void
    {
        Other::exceptionally(static function (): void {
            trigger_error('Message', E_USER_WARNING);
        }, E_USER_NOTICE);
    }

    /**
     * @withoutErrorHandler TODO не поддерживается в phpunit 9
     * @dataProvider data1
     * @doesNotPerformAssertions
     */
    function testItDoesNotThrowSuppressedError(int $level): void
    {
        Other::exceptionally(static function () use ($level): void {
            @trigger_error('Message', $level);
        });
    }
}
