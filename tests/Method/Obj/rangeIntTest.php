<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;

/**
 */
class rangeIntTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider data
     */
    function test_main(int $start, int $end, int $step)
    {
        $this->assertSame(\range($start, $end, $step), \iterator_to_array(Obj::rangeInt($start, $end, $step)));
    }

    function test_err_zero_step()
    {
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage(Obj::class . '::rangeInt(): Argument #3 ($step) cannot be 0');

        \iterator_to_array(Obj::rangeInt(1, 1, 0));
    }

    function test_err_step_exceeds()
    {
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage(Obj::class . '::rangeInt(): Argument #3 ($step) must be less than the range spanned by argument #1 ($start) and argument #2 ($end)');

        \iterator_to_array(Obj::rangeInt(1, 3, 4));
    }

    function test_err_step_exceeds_2()
    {
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage(Obj::class . '::rangeInt(): Argument #3 ($step) must be less than the range spanned by argument #1 ($start) and argument #2 ($end)');

        \iterator_to_array(Obj::rangeInt(3, 1, 4));
    }

    static function data(): array
    {
        return [
            [1, 10, 1],
            [1, 10, 2],
            [1, 10, 3],
            [10, 1, 3],
            [1, 1, 1],
            [1, 5, 2],
            [1, 1, 2],
            [1, 1, 3],
            [2, 2, 4],
            [1, 2, 1],
            [-10, 10, 1],
            [-10, 10, 2],
            [-10, 10, 3],
        ];
    }
}
