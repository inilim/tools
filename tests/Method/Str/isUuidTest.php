<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class isUuidTest extends TestCase
{
    /**
     * @dataProvider validUuidList
     */
    function testIsUuidWithValidUuid($uuid)
    {
        $this->assertTrue(Str::isUuid($uuid));
    }

    /**
     * @dataProvider invalidUuidList
     */
    function testIsUuidWithInvalidUuid($uuid)
    {
        $this->assertFalse(Str::isUuid($uuid));
    }

    /**
     * @dataProvider uuidVersionList
     */
    function testIsUuidWithVersion($uuid, $version, $passes)
    {
        $this->assertSame(Str::isUuid($uuid, $version), $passes);
    }

    static function uuidVersionList()
    {
        return [
            ['00000000-0000-0000-0000-000000000000', null, true],
            ['00000000-0000-0000-0000-000000000000', 0, true],
            ['00000000-0000-0000-0000-000000000000', 1, false],
            ['00000000-0000-0000-0000-000000000000', 42, false],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1', null, true],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1', 1, true],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1', 4, false],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1', 42, false],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', null, true],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', 1, false],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', 2, true],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', 42, false],
            ['76a4ba72-cc4e-3e1d-b52d-856382f408c3', null, true],
            ['76a4ba72-cc4e-3e1d-b52d-856382f408c3', 1, false],
            ['76a4ba72-cc4e-3e1d-b52d-856382f408c3', 3, true],
            ['76a4ba72-cc4e-3e1d-b52d-856382f408c3', 42, false],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', null, true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 1, false],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 4, true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 42, false],
            ['d3b2b5a9-d433-5c58-b038-4fa13696e357', null, true],
            ['d3b2b5a9-d433-5c58-b038-4fa13696e357', 1, false],
            ['d3b2b5a9-d433-5c58-b038-4fa13696e357', 5, true],
            ['d3b2b5a9-d433-5c58-b038-4fa13696e357', 42, false],
            ['1ef97d97-b5ab-67d8-9f12-5600051f1387', null, true],
            ['1ef97d97-b5ab-67d8-9f12-5600051f1387', 1, false],
            ['1ef97d97-b5ab-67d8-9f12-5600051f1387', 6, true],
            ['1ef97d97-b5ab-67d8-9f12-5600051f1387', 42, false],
            ['0192e4b9-92eb-7aec-8707-1becfb1e3eb7', null, true],
            ['0192e4b9-92eb-7aec-8707-1becfb1e3eb7', 1, false],
            ['0192e4b9-92eb-7aec-8707-1becfb1e3eb7', 7, true],
            ['0192e4b9-92eb-7aec-8707-1becfb1e3eb7', 42, false],
            ['07e80a1f-1629-831f-811f-c595103c91b5', null, true],
            ['07e80a1f-1629-831f-811f-c595103c91b5', 1, false],
            ['07e80a1f-1629-831f-811f-c595103c91b5', 8, true],
            ['07e80a1f-1629-831f-811f-c595103c91b5', 42, false],
            ['FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF', null, true],
            ['FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF', 1, false],
            ['FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF', 42, false],
            ['FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF', 'max', true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', null, true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 1, false],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 4, true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 42, false],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', null, false],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', 1, false],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', 4, false],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', 42, false],
        ];
    }

    static function invalidUuidList()
    {
        return [
            ['not a valid uuid so we can test this'],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66'],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1' . PHP_EOL],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1 '],
            [' 145a1e72-d11d-11e8-a8d5-f2801f1b9fd1'],
            ['145a1e72-d11d-11e8-a8d5-f2z01f1b9fd1'],
            ['3f6f8cb0-c57d-11e1-9b21-0800200c9a6'],
            ['af6f8cb-c57d-11e1-9b21-0800200c9a66'],
            ['af6f8cb0c57d11e19b210800200c9a66'],
            ['ff6f8cb0-c57da-51e1-9b21-0800200c9a66'],
        ];
    }

    static function validUuidList()
    {
        return [
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de'],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1'],
            ['00000000-0000-0000-0000-000000000000'],
            ['e60d3f48-95d7-4d8d-aad0-856f29a27da2'],
            ['ff6f8cb0-c57d-11e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-31e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-41e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-51e1-9b21-0800200c9a66'],
            ['FF6F8CB0-C57D-11E1-9B21-0800200C9A66'],
        ];
    }
}
