<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Test\TestCase;

class getSuggestionLevenshteinTest extends TestCase
{
    function test()
    {
        $this->assertSame([], Exp::getSuggestionLevenshtein([], ''));
        $this->assertSame([], Exp::getSuggestionLevenshtein([], 'a'));
        $this->assertSame([], Exp::getSuggestionLevenshtein(['a'], 'a'));
        $this->assertSame(['a', 'b'], Exp::getSuggestionLevenshtein(['a', 'b'], ''));
        $this->assertSame(['b'], Exp::getSuggestionLevenshtein(['a', 'b'], 'a')); // ignore 100% match
        $this->assertSame(['a1', 'a2'], Exp::getSuggestionLevenshtein(['a1', 'a2'], 'a'));
        $this->assertSame([], Exp::getSuggestionLevenshtein(['aaa', 'bbb'], 'a'));
        $this->assertSame([], Exp::getSuggestionLevenshtein(['aaa', 'bbb'], 'ab'));
        $this->assertSame([], Exp::getSuggestionLevenshtein(['aaa', 'bbb'], 'abc'));
        $this->assertSame(['bar'], Exp::getSuggestionLevenshtein(['foo', 'bar', 'baz'], 'baz'));
        $this->assertSame(['abcd'], Exp::getSuggestionLevenshtein(['abcd'], 'acbd'));
        $this->assertSame(['abcd'], Exp::getSuggestionLevenshtein(['abcd'], 'axbd'));
        $this->assertSame([], Exp::getSuggestionLevenshtein(['abcd'], 'axyd')); // 'tags' vs 'this'
        $this->assertSame([], Exp::getSuggestionLevenshtein(['setItem'], 'item'));
    }
}
