<?php

namespace Inilim\Tool\Test\Method\Obj;

use Inilim\Tool\Obj;

/**
 * @requires PHP >= 8.1
 */
class pregReplaceCallbackGeneratorTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * Базовый тест: одиночный паттерн, одиночная строка, замена каждого совпадения.
     */
    public function testBasicReplacement(): void
    {
        $pattern = '/\d/';
        $subject = 'a1b2c3';

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject);

        foreach ($generator as [$matches, $change]) {
            // заменяем каждую цифру на 'X'
            $change('X');
        }

        $result = $generator->getReturn();
        $this->assertSame('aXbXcX', $result);
    }

    /**
     * Тест с массивом паттернов.
     */
    public function testMultiplePatterns(): void
    {
        $patterns = ['/\d/', '/[aeiou]/'];
        $subject = 'a1b2c3';

        $generator = Obj::pregReplaceCallbackGenerator($patterns, $subject);

        foreach ($generator as [$matches, $change]) {
            // заменяем цифры на '0', гласные на '*'
            if (preg_match('/\d/', $matches[0])) {
                $change('0');
            } else {
                $change('*');
            }
        }

        $result = $generator->getReturn();
        // Ожидаем: 'a' -> '*', '1' -> '0', 'b' не меняется, '2' -> '0', 'c' не меняется, '3' -> '0'
        $this->assertSame('*0b0c0', $result);
    }

    /**
     * Тест с массивом subject.
     */
    public function testMultipleSubjects(): void
    {
        $pattern = '/\d/';
        $subjects = ['a1', 'b2', 'c3'];

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subjects);

        foreach ($generator as [$matches, $change]) {
            $change('X');
        }

        $result = $generator->getReturn();
        $this->assertSame(['aX', 'bX', 'cX'], $result);
    }

    /**
     * Тест с ограничением limit.
     */
    public function testLimit(): void
    {
        $pattern = '/\d/';
        $subject = '1 2 3 4 5';

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject, $limit = 2);

        $replacements = 0;
        foreach ($generator as [$matches, $change]) {
            $change('X');
            $replacements++;
        }

        $this->assertSame(2, $replacements);
        $result = $generator->getReturn();
        $this->assertSame('X X 3 4 5', $result);
    }

    /**
     * Тест с флагом PREG_OFFSET_CAPTURE.
     * В этом режиме $matches содержит подмассивы [string, offset].
     * Наш callback ожидает простые строки, но он их корректно извлечёт.
     */
    public function testFlagOffsetCapture(): void
    {
        $pattern = '/\d/';
        $subject = 'a1b2';
        $flags = \PREG_OFFSET_CAPTURE;

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject, -1, $flags);

        $i = 0;
        foreach ($generator as [$matches, $change]) {
            // $matches[0] будет массивом ['1', 1]
            $this->assertIsArray($matches[0]);
            if ($i === 0) {
                $this->assertSame('1', $matches[0][0]);
                $this->assertSame(1, $matches[0][1]);
            }
            if ($i === 1) {
                $this->assertSame('2', $matches[0][0]);
                $this->assertSame(3, $matches[0][1]);
            }
            $change('X');
            $i++;
        }

        $result = $generator->getReturn();
        $this->assertSame('aXbX', $result);
    }

    /**
     * Тест, когда замены не влияют на позиции последующих совпадений.
     * Увеличиваем заменяемую строку, и убеждаемся, что следующее совпадение
     * ищется в исходных позициях.
     */
    public function testSubsequentMatchesUnaffected(): void
    {
        $pattern = '/a/';
        $subject = 'aba';

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject);

        $first = true;
        foreach ($generator as [$matches, $change]) {
            if ($first) {
                // заменяем 'a' на 'aa' (увеличиваем длину)
                $change('aa');
                $first = false;
            } else {
                // Второе совпадение (исходная позиция 2) должно быть заменено независимо
                $change('X');
            }
        }

        $result = $generator->getReturn();
        // Ожидаем: первая 'a' (позиция 0) -> 'aa'; вторая 'a' (позиция 2) -> 'X'
        // Итог: 'aa' + 'b' + 'X' = 'aabX'
        $this->assertSame('aabX', $result);
    }

    /**
     * Тест с пустым subject (строка).
     */
    public function testEmptyStringSubject(): void
    {
        $pattern = '/\d/';
        $subject = '';

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject);

        $iterations = 0;
        foreach ($generator as $_) {
            $iterations++;
        }

        $this->assertSame(0, $iterations);
        $result = $generator->getReturn();
        $this->assertSame('', $result);
    }

    /**
     * Тест с пустым массивом subject.
     */
    public function testEmptyArraySubject(): void
    {
        $pattern = '/\d/';
        $subject = [];

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject);

        $iterations = 0;
        foreach ($generator as $_) {
            $iterations++;
        }

        $this->assertSame(0, $iterations);
        $result = $generator->getReturn();
        $this->assertSame([], $result);
    }

    /**
     * Тест, когда паттерн не найден.
     */
    public function testNoMatches(): void
    {
        $pattern = '/\d/';
        $subject = 'abc';

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject);

        $iterations = 0;
        foreach ($generator as $_) {
            $iterations++;
        }

        $this->assertSame(0, $iterations);
        $result = $generator->getReturn();
        $this->assertSame('abc', $result);
    }

    /**
     * Тест, что в каждой итерации передаются правильные $matches.
     */
    public function testMatchesStructure(): void
    {
        $pattern = '/(\d)(\w)/';
        $subject = '1a2b';

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject);

        $expectedMatches = [
            ['1a', '1', 'a'],
            ['2b', '2', 'b']
        ];

        $index = 0;
        foreach ($generator as [$matches, $change]) {
            $this->assertSame($expectedMatches[$index], $matches);
            $change('X');
            $index++;
        }

        $result = $generator->getReturn();
        $this->assertSame('XX', $result);
    }

    /**
     * Тест, что вызов getReturn() до полного перебора генератора выбрасывает исключение.
     * Согласно контракту Generator, getReturn() можно вызывать только после завершения.
     * Мы проверим, что это поведение сохраняется.
     */
    public function testGetReturnBeforeTerminationThrows(): void
    {
        $this->expectException(\Exception::class); // или более конкретно \Error, зависит от версии
        // В PHP 8.1 вызов getReturn() у активного генератора бросает \Error.

        $pattern = '/\d/';
        $subject = '123';

        $generator = Obj::pregReplaceCallbackGenerator($pattern, $subject);
        $generator->current(); // запускаем первую итерацию
        $generator->getReturn(); // должен бросить исключение
    }
}
