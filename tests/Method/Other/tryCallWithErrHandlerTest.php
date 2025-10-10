<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\TestProcess;
use PHPUnit\Framework\Attributes\DataProvider;

class tryCallWithErrHandlerTest extends TestCase
{
    // function test2()
    // {
    //     $testProcess = TestProcess::self();
    //     foreach (CasePhpT::self()->cases([Other::class, 'tryCallWithErrHandler']) as $case) {
    //         // dd($case);
    //         $asserts = $testProcess->testWithPhp('7.4', $case);
    //         foreach ($asserts as $assert) {
    //             $this->assertProcess($assert);
    //         }
    //         // de();
    //     }
    // }

    /**
     * @dataProvider data
     */
    function test_not_show_error($callable)
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

    /**
     * @dataProvider dataEcho
     */
    function test_echo_after_error($callable)
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

    function test_scope_std_class()
    {
        \error_reporting(\E_ALL);

        $self = $this;

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        Other::tryCallWithErrHandler(
            static function ($stdClass) use ($self) {
                $self->assertInstanceOf(\stdClass::class, $stdClass);
                $stdClass->testProp = 'Hello';

                \trigger_error('ERROR', \E_USER_ERROR);

                $self->assertEquals('World', $stdClass->testProp ?? null);
            },
            static function ($_, $_1, $_2, $_3, $context) use ($self) {
                $self->assertInstanceOf(\stdClass::class, $context['obj']);
                $self->assertFalse($context['isException']);
                $self->assertObjectHasProperty('testProp', $context['obj']);
                $self->assertEquals('Hello', $context['obj']->testProp ?? null);

                $context['obj']->testProp = 'World';
            }
        );

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        Other::tryCallWithErrHandler(
            static function ($stdClass) {
                $stdClass->testProp = 'Hello';
                throw new \Exception;
            },
            static function ($_, $_1, $_2, $_3, $context) use ($self) {
                $self->assertTrue($context['isException']);
                $self->assertInstanceOf(\stdClass::class, $context['obj']);
                $self->assertObjectHasProperty('testProp', $context['obj']);
                $self->assertEquals('Hello', $context['obj']->testProp ?? null);
            }
        );
    }

    function test_throw_from_handle()
    {
        \error_reporting(\E_ALL);
        $self = $this;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('greetings from the handler');

        Other::tryCallWithErrHandler(
            static function () {
                \trigger_error('ERROR', \E_USER_ERROR);
            },
            static function ($_, $_1, $_2, $_3, $context) use ($self) {
                $self->assertFalse($context['isException']);
                throw new \Exception('greetings from the handler');
            }
        );
    }

    function test_suppress_throw_from_callable()
    {
        \error_reporting(\E_ALL);
        $catch = false;
        try {
            Other::tryCallWithErrHandler(
                static function () {
                    throw new \Exception;
                },
                null
            );
        } catch (\Throwable $e) {
            $catch = true;
        }

        $this->assertFalse($catch);
    }

    function test_flag_suppress_error()
    {
        \error_reporting(\E_ALL);
        $self = $this;

        Other::tryCallWithErrHandler(
            static function () use ($self) {
                @\file_get_contents('dkawjldwkldj.djawd');
            },
            static function ($_, $_1, $_2, $_3, $context) use ($self) {
                $self->assertTrue($context['isSuppress']);
            }
        );

        Other::tryCallWithErrHandler(
            static function () use ($self) {
                \file_get_contents('dkawjldwkldj.djawd');
            },
            static function ($_, $_1, $_2, $_3, $context) use ($self) {
                $self->assertFalse($context['isSuppress']);
            }
        );
    }

    function test_catch_via_callable_and_handler()
    {
        \error_reporting(\E_ALL);
        $self = $this;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('I\'m from the closure');

        Other::tryCallWithErrHandler(
            static function () use ($self) {
                throw new \Exception('I\'m from the closure');
            },
            static function ($_, $_1, $_2, $_3, $context) use ($self) {
                $self->assertTrue($context['isException']);
                throw $context['exception'];
            }
        );
    }

    function test_level_error()
    {
        \error_reporting(\E_ALL);
        $self = $this;

        Other::tryCallWithErrHandler(
            static function () {
                \trigger_error('E_USER_ERROR', \E_USER_ERROR);
            },
            static function ($lvl, $msg) use ($self) {
                $self->assertEquals(\E_USER_ERROR, $lvl);
                $self->assertEquals('E_USER_ERROR', $msg);
            }
        );
    }

    function test_count_exec_handler()
    {
        \error_reporting(\E_ALL);
        $count = 0;

        Other::tryCallWithErrHandler(
            static function () {
                \trigger_error('', \E_USER_ERROR);
                \trigger_error('', \E_USER_ERROR);
                \trigger_error('', \E_USER_ERROR);
            },
            static function () use (&$count) {
                $count++;
            }
        );

        $this->assertEquals(3, $count);
    }

    function test_count_exec_callable()
    {
        \error_reporting(\E_ALL);
        $count = 0;

        Other::tryCallWithErrHandler(
            static function () use (&$count) {
                $count++;
            },
            null
        );

        $this->assertEquals(1, $count);
    }

    function test_value_return_callable()
    {
        \error_reporting(\E_ALL);

        $result = Other::tryCallWithErrHandler(
            static function () {
                \trigger_error('', \E_USER_ERROR);
                return 'result';
            },
            null
        );

        $this->assertEquals('result', $result);

        $result = Other::tryCallWithErrHandler(
            static function () {
                $result = 'do_result';
                \trigger_error('', \E_USER_ERROR);
                return $result;
            },
            null
        );

        $this->assertEquals('do_result', $result);
    }

    function test_1()
    {
        // проверить что пользовательский обработчик возвращается

        \set_error_handler(static function () {
            static $id = 'user';
            return true;
        }, \E_ALL);

        Other::tryCallWithErrHandler(
            static function () {},
            static function () {
                static $id = 'fn';
                return true;
            }
        );

        $callable = \set_error_handler(static fn() => true);
        \restore_error_handler();
        $this->assertInstanceOf(\Closure::class, $callable);
        $reflectionFunction = new \ReflectionFunction($callable);
        $staticVariables = $reflectionFunction->getStaticVariables();
        $this->assertTrue(isset($staticVariables['id']));
        $this->assertSame('user', $staticVariables['id']);

        // ---------------------------------------------
        // Вложенный
        // ---------------------------------------------

        Other::tryCallWithErrHandler(
            static function () {
                Other::tryCallWithErrHandler(
                    static function () {},
                    static function () {
                        static $id = 'fn_2';
                        return true;
                    }
                );
            },
            static function () {
                static $id = 'fn_1';
                return true;
            }
        );

        $callable = \set_error_handler(static fn() => true);
        \restore_error_handler();
        $this->assertInstanceOf(\Closure::class, $callable);
        $reflectionFunction = new \ReflectionFunction($callable);
        $staticVariables = $reflectionFunction->getStaticVariables();
        $this->assertTrue(isset($staticVariables['id']));
        $this->assertSame('user', $staticVariables['id']);
    }

    // function test_default_error_handler()
    // {
    //     \error_reporting(\E_ALL);

    //     $this->expectUserDeprecationMessage('__THIS_ERROR__');

    //     // \ob_start();
    //     Other::tryCallWithErrHandler(
    //         static function () {
    //             \trigger_error('__THIS_ERROR__', \E_USER_DEPRECATED);
    //         },
    //         static function () {
    //             return false;
    //         }
    //     );

    //     // $this->assertTrue(\str_contains(\ob_get_clean(), '__THIS_ERROR__'));
    // }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

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
