<?php

declare(strict_types=1);

use Inilim\Tool\Other;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestProcess;

class iterateWhileTest extends \Inilim\Tool\Test\TestCase
{
    function test()
    {
        // ---------------------------------------------
        // Дефолтное количество итераций
        // ---------------------------------------------

        $countIteration = 0;
        Other::iterateWhile(static function () use (&$countIteration) {
            $countIteration++;
            return true;
        });

        $this->assertSame(5, $countIteration);

        // ---------------------------------------------
        // Иное количество итераций
        // ---------------------------------------------

        $countIteration = 0;
        $t = \mt_rand(6, 25);
        Other::iterateWhile(static function () use (&$countIteration) {
            $countIteration++;
            return true;
        }, $t);

        $this->assertSame($t, $countIteration);
        unset($t);

        // ---------------------------------------------
        // прервать сразу
        // ---------------------------------------------

        $countIteration = 0;
        Other::iterateWhile(static function () use (&$countIteration) {
            $countIteration++;
            return false;
        });

        $this->assertSame(1, $countIteration);

        // ---------------------------------------------
        // прервать после
        // ---------------------------------------------

        $countIteration = 0;
        Other::iterateWhile(static function () use (&$countIteration) {

            $countIteration++;

            if ($countIteration >= 3) {
                return false;
            }
            return true;
        });

        $this->assertSame(3, $countIteration);

        // ---------------------------------------------
        // вызов break функции
        // ---------------------------------------------

        $break = false;
        Other::iterateWhile(static function () {
            return true;
        }, 5, static function () use (&$break) {
            $break = true;
        });

        $this->assertTrue($break);
        unset($break);

        // ---------------------------------------------
        // вызов break функции сразу
        // ---------------------------------------------

        $break = false;
        Other::iterateWhile(static function () {
            return false;
        }, 5, static function () use (&$break) {
            $break = true;
        });

        $this->assertTrue($break);
        unset($break);

        // ---------------------------------------------
        // отрицательное значение итераций
        // ---------------------------------------------

        $break = false;
        $countIteration = 0;
        Other::iterateWhile(static function () use (&$countIteration) {
            $countIteration++;
            return true;
        }, -1, static function () use (&$break) {
            $break = true;
        });

        $this->assertSame(0, $countIteration);
        $this->assertTrue($break);
        unset($break);

        // ---------------------------------------------
        // нулевое значение итераций
        // ---------------------------------------------

        $break = false;
        $countIteration = 0;
        Other::iterateWhile(static function () use (&$countIteration) {
            $countIteration++;
            return true;
        }, 0, static function () use (&$break) {
            $break = true;
        });

        $this->assertSame(0, $countIteration);
        $this->assertTrue($break);
        unset($break);
    }

    function testArgs()
    {
        $countIteration = 0;
        $internalCountIteration = null;
        $internalMaxIteration = null;
        Other::iterateWhile(static function ($curI, $maxI) use (&$countIteration, &$internalCountIteration, &$internalMaxIteration) {
            $countIteration++;
            $internalCountIteration = $curI;
            $internalMaxIteration = $maxI;
            return true;
        });

        $this->assertSame(5, $countIteration);
        // INFO start with zero
        $this->assertSame(4, $internalCountIteration);
        $this->assertSame(5, $internalMaxIteration);
    }

    function testArgsBreak()
    {
        $internalCountIteration = null;
        $internalMaxIteration = null;
        Other::iterateWhile(static function () {
            return true;
        }, 5, static function ($curI, $maxI) use (&$internalCountIteration, &$internalMaxIteration) {
            $internalCountIteration = $curI;
            $internalMaxIteration = $maxI;
        });

        // INFO start with zero
        $this->assertSame(4, $internalCountIteration);
        $this->assertSame(5, $internalMaxIteration);
    }
}
