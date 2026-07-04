<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class getRefTest extends TestCase
{
    private array $arr = [
        '' => 'first',
        1 => 'second',
        7 => [
            'item' => 'third',
        ],
    ];

    public function testReferenceUpdateAndAutoAddMissingKey(): void
    {
        $dolly = $this->arr;
        $item = &Arr::getRef()($dolly, '');
        $item = 'changed';
        $this->assertSame([
            '' => 'changed',
            1 => 'second',
            7 => [
                'item' => 'third',
            ],
        ], $dolly);

        $dolly = $this->arr;
        $item = &Arr::getRef()($dolly, 'undefined');
        $item = 'changed';
        $this->assertSame([
            '' => 'first',
            1 => 'second',
            7 => [
                'item' => 'third',
            ],
            'undefined' => 'changed',
        ], $dolly);
    }

    public function testNestedReferenceAssignmentAndFullArrayOverride(): void
    {
        $dolly = $this->arr;
        $item = &Arr::getRef()($dolly, []);
        $item = 'changed';
        $this->assertSame('changed', $dolly);

        $dolly = $this->arr;
        $item = &Arr::getRef()($dolly, [7, 'item']);
        $item = 'changed';
        $this->assertSame([
            '' => 'first',
            1 => 'second',
            7 => [
                'item' => 'changed',
            ],
        ], $dolly);
    }

    public function testExceptionOnInvalidNestedReference(): void
    {
        $dolly = $this->arr;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Traversed item is not an array.');

        $item = &Arr::getRef()($dolly, [7, 'item', 3]);
    }
}
