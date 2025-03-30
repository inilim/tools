<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class tryCallWithErrHandlerTest extends TestCase
{
    #[DataProvider('data')]
    function test1($callable)
    {
        \error_reporting(\E_ALL);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        \ob_start();
        Other::tryCallWithErrHandler($callable, null);
        $this->assertEquals('', \ob_get_contents());
        \ob_end_clean();
    }

    #[DataProvider('dataEcho')]
    function test2($callable)
    {
        \error_reporting(\E_ALL);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        \ob_start();
        Other::tryCallWithErrHandler($callable, null);
        $this->assertEquals('startend', \ob_get_contents());
        \ob_end_clean();
    }

    static function data()
    {
        return [
            [static function () {
                \trigger_error('ERROR', \E_USER_ERROR);
            }],
            [static function () {
                \trigger_error('ERROR', \E_USER_NOTICE);
            }],
            [static function () {
                \trigger_error('ERROR', \E_USER_WARNING);
            }],
            [static function () {
                \trigger_error('ERROR', \E_USER_DEPRECATED);
            }],
            [static function () {
                callNotFoundFn();
            }],
            [static function () {
                echo $notFoundVar;
            }],
        ];
    }

    static function dataEcho()
    {
        return [
            [static function () {
                echo 'start';
                \trigger_error('ERROR', \E_USER_ERROR);
                echo 'end';
            }],
            [static function () {
                echo 'start';
                \trigger_error('ERROR', \E_USER_NOTICE);
                echo 'end';
            }],
            [static function () {
                echo 'start';
                \trigger_error('ERROR', \E_USER_WARNING);
                echo 'end';
            }],
            [static function () {
                echo 'start';
                \trigger_error('ERROR', \E_USER_DEPRECATED);
                echo 'end';
            }],
            [static function () {
                echo 'start';
                try {
                    callNotFoundFn();
                } catch (\Throwable $e) {
                }
                echo 'end';
            }],
            [static function () {
                echo 'start';
                echo $notFoundVar;
                echo 'end';
            }],
        ];
    }
}
