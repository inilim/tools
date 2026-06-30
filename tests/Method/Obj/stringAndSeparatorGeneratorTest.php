<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;

/**
 */
class stringAndSeparatorGeneratorTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @test
     */
    public function it_yields_parts_separated_by_a_single_character(): void
    {
        $generator = Obj::stringAndSeparatorGenerator('a,b,c', ',');

        $result = iterator_to_array($generator);

        $this->assertSame(['a', 'b', 'c'], $result);
    }

    /**
     * @test
     */
    public function it_yields_parts_separated_by_a_multi_character_separator(): void
    {
        $generator = Obj::stringAndSeparatorGenerator('ab--cd--ef', '--');

        $result = iterator_to_array($generator);

        $this->assertSame(['ab', 'cd', 'ef'], $result);
    }

    /**
     * @test
     */
    public function it_yields_empty_string_when_separator_is_at_the_beginning(): void
    {
        $generator = Obj::stringAndSeparatorGenerator(',a,b', ',');

        $result = iterator_to_array($generator);

        $this->assertSame(['', 'a', 'b'], $result);
    }

    /**
     * @test
     */
    public function it_yields_empty_string_when_separator_is_at_the_end(): void
    {
        $generator = Obj::stringAndSeparatorGenerator('a,b,', ',');

        $result = iterator_to_array($generator);

        $this->assertSame(['a', 'b', ''], $result);
    }

    /**
     * @test
     */
    public function it_yields_two_empty_strings_for_a_string_that_is_only_the_separator(): void
    {
        $generator = Obj::stringAndSeparatorGenerator(',', ',');

        $result = iterator_to_array($generator);

        $this->assertSame(['', ''], $result);
    }

    /**
     * @test
     */
    public function it_yields_the_whole_string_when_separator_is_not_found(): void
    {
        $generator = Obj::stringAndSeparatorGenerator('abc', ',');

        $result = iterator_to_array($generator);

        $this->assertSame(['abc'], $result);
    }

    /**
     * @test
     */
    public function it_yields_an_empty_string_for_an_empty_input_string(): void
    {
        $generator = Obj::stringAndSeparatorGenerator('', ',');

        $result = iterator_to_array($generator);

        $this->assertSame([], $result);
    }

    /**
     * @test
     */
    public function it_throws_value_error_when_separator_is_empty(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        // strpos() не принимает пустую строку-иглу, начиная с PHP 8.0
        iterator_to_array(Obj::stringAndSeparatorGenerator('abc', ''));
    }
}
