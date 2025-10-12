<?php

namespace Inilim\Tool\Test\Method\Lar;

use Inilim\Tool\Lar;
use Inilim\Tool\Test\TestCase;

class dataForgetTest extends TestCase
{
    public function testDataRemove()
    {
        $data = ['foo' => 'bar', 'hello' => 'world'];

        $this->assertEquals(
            ['hello' => 'world'],
            Lar::dataForget()($data, 'foo')
        );

        $data = ['foo' => 'bar', 'hello' => 'world'];

        $this->assertEquals(
            ['foo' => 'bar', 'hello' => 'world'],
            Lar::dataForget()($data, 'nothing')
        );

        $data = ['one' => ['two' => ['three' => 'hello', 'four' => ['five']]]];

        $this->assertEquals(
            ['one' => ['two' => ['four' => ['five']]]],
            Lar::dataForget()($data, 'one.two.three')
        );
    }

    public function testDataRemoveWithStar()
    {
        $data = [
            'article' => [
                'title' => 'Foo',
                'comments' => [
                    ['comment' => 'foo', 'name' => 'First'],
                    ['comment' => 'bar', 'name' => 'Second'],
                ],
            ],
        ];

        $this->assertEquals(
            [
                'article' => [
                    'title' => 'Foo',
                    'comments' => [
                        ['comment' => 'foo'],
                        ['comment' => 'bar'],
                    ],
                ],
            ],
            Lar::dataForget()($data, 'article.comments.*.name')
        );
    }

    public function testDataRemoveWithDoubleStar()
    {
        $data = [
            'posts' => [
                (object) [
                    'comments' => [
                        (object) ['name' => 'First', 'comment' => 'foo'],
                        (object) ['name' => 'Second', 'comment' => 'bar'],
                    ],
                ],
                (object) [
                    'comments' => [
                        (object) ['name' => 'Third', 'comment' => 'hello'],
                        (object) ['name' => 'Fourth', 'comment' => 'world'],
                    ],
                ],
            ],
        ];

        Lar::dataForget()($data, 'posts.*.comments.*.name');

        $this->assertEquals([
            'posts' => [
                (object) [
                    'comments' => [
                        (object) ['comment' => 'foo'],
                        (object) ['comment' => 'bar'],
                    ],
                ],
                (object) [
                    'comments' => [
                        (object) ['comment' => 'hello'],
                        (object) ['comment' => 'world'],
                    ],
                ],
            ],
        ], $data);
    }
}
