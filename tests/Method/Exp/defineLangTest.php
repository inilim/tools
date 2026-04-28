<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Test\TestCase;

class defineLangTest extends TestCase
{
    // Edge cases: empty input or input that becomes empty after cleanup
    public function testEmptyStringReturnsEmptyArray(): void
    {
        $this->assertSame([], Exp::defineLang(''));
    }

    public function testOnlyNonLettersReturnsEmptyArray(): void
    {
        $this->assertSame([], Exp::defineLang('123 !@#'));
    }

    public function testOnlyWhitespaceReturnsEmptyArray(): void
    {
        $this->assertSame([], Exp::defineLang("   \t \n"));
    }

    public function testStringBecomesEmptyAfterRemovingNonLettersReturnsEmptyArray(): void
    {
        // After stripping non-letters, nothing remains
        $this->assertSame([], Exp::defineLang('1234'));
    }

    // ----------------------------------------------------------------
    // Single script detection
    // ----------------------------------------------------------------

    public function testLatinOnly(): void
    {
        $this->assertSame(['latin'], Exp::defineLang('Hello'));
    }

    public function testCyrillicOnly(): void
    {
        $this->assertSame(['cyrillic'], Exp::defineLang('Привет'));
    }

    public function testGreekOnly(): void
    {
        // Greek appears later in the generator; still detected correctly.
        $this->assertSame(['greek'], Exp::defineLang('Γειά'));
    }

    public function testHanOnly(): void
    {
        $this->assertSame(['han'], Exp::defineLang('汉字'));
    }

    public function testAccentedLatinIsLatin(): void
    {
        $this->assertSame(['latin'], Exp::defineLang('café'));
    }

    // ----------------------------------------------------------------
    // Multiple scripts – order is determined by the generator sequence
    // ----------------------------------------------------------------

    public function testLatinAndCyrillicMixed(): void
    {
        // Latin comes before Cyrillic in the generator.
        $this->assertSame(['latin', 'cyrillic'], Exp::defineLang('Hello Привет'));
    }

    public function testCyrillicThenLatinStillReturnsLatinFirst(): void
    {
        // Even if input starts with Cyrillic, Latin is checked first.
        $this->assertSame(['latin', 'cyrillic'], Exp::defineLang('Привет World'));
    }

    public function testMultipleScriptsLatinCyrillicGreek(): void
    {
        // Generator order: latin → cyrillic → ... → greek
        // 'AαБ' → strip non-letters → 'AαБ'
        // 1. Latin removes 'A'   → add 'latin',   text = 'αБ'
        // 2. Cyrillic removes 'Б' → add 'cyrillic', text = 'α'
        // 3. Later Greek removes 'α' → add 'greek'
        $this->assertSame(
            ['latin', 'cyrillic', 'greek'],
            Exp::defineLang('AαБ')
        );
    }

    // ----------------------------------------------------------------
    // Input with digits and punctuation – they are ignored
    // ----------------------------------------------------------------

    public function testDigitsAndPunctuationAreStripped(): void
    {
        $this->assertSame(['latin'], Exp::defineLang('abc123!@#'));
    }

    // ----------------------------------------------------------------
    // Data provider covering many cases from above
    // ----------------------------------------------------------------

    /**
     * @dataProvider scriptDetectionProvider
     */
    public function testScriptDetection(string $input, array $expected): void
    {
        $this->assertSame($expected, Exp::defineLang($input));
    }

    public function scriptDetectionProvider(): array
    {
        return [
            'empty string'                 => ['', []],
            'only digits'                  => ['123', []],
            'only punctuation'             => ['!@#', []],
            'only whitespace'              => ['   ', []],
            'Latin only'                   => ['Hello', ['latin']],
            'Cyrillic only'                => ['Привет', ['cyrillic']],
            'Greek only'                   => ['Γειά', ['greek']],
            'Han only'                     => ['汉字', ['han']],
            'Mixed Latin + Cyrillic'       => ['Hello Привет', ['latin', 'cyrillic']],
            'Cyrillic first, then Latin'   => ['Привет World', ['latin', 'cyrillic']],
            'Latin + Greek + Cyrillic'     => ['AαБ', ['latin', 'cyrillic', 'greek']],
            'Digits with letters'          => ['123abc', ['latin']],
            'Accented Latin'               => ['café', ['latin']],
        ];
    }
}
