<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class get_resource_idTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @covers \Symfony\Polyfill\Php80\Php80::get_resource_id
     */
    function testGetResourceIdWithValidResource()
    {
        $resource = fopen(__FILE__, 'r');
        $resourceId = (int) $resource;
        $this->assertSame($resourceId, PF::get_resource_id($resource));
        fclose($resource);
        $this->assertSame($resourceId, PF::get_resource_id($resource));
    }

    /**
     * @covers \Symfony\Polyfill\Php80\Php80::get_resource_id
     *
     * @dataProvider invalidResourceProvider
     */
    function testGetResourceWithInvalidValue($value)
    {
        $this->expectException('TypeError');
        PF::get_resource_id($value);
    }

    static function invalidResourceProvider()
    {
        return [
            [true],
            [null],
            [new \stdClass()],
            ['test'],
            [10],
            [10.0],
        ];
    }
}
