<?php

declare(strict_types=1);

use Inilim\Tool\Other;

class _refDotsTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider data
     */
    function test($actual, $expected)
    {
        $result = Other::_refDots($actual);
        $this->assertSame($expected, $result['...']);
        unset($result['...']);
        $this->assertSame($actual, $result);
    }

    function test1()
    {
        // Проверяем ссылки
        $result = Other::_refDots([123, 'key2', 123.123]);

        $result['...'][0] = 333;
        $this->assertSame(333, $result[0]);
        $result['...'][1] = 'new_string';
        $this->assertSame('new_string', $result[1]);

        // invert
        $result = Other::_refDots([123, 'key2', 123.123]);

        $result[0] = 333;
        $this->assertSame(333, $result['...'][0]);
        $result[1] = 'new_string';
        $this->assertSame('new_string', $result['...'][1]);
    }

    static function data()
    {
        return [
            [$a = [123, 'key2', 123.123], \array_values($a)],
            [$a = ['k1' => 123, 'k2' => 'value', 'k3' => 123.123], \array_values($a)],
            [$a = ['k1' => new \stdClass], \array_values($a)],
        ];
    }
}
