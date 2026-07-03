<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @return \Generator<int,string>
 * @throws \InvalidArgumentException
 */
function lines(string $content, int $startLine = 0): \Generator
{
    if ($startLine !== 0) {
        \Inilim\Tool\Method\Assert\positiveInteger($startLine);
    }
    $offset = 0;
    $length = \strlen($content);
    $skip   = $startLine;
    $endedWithDelimiter = false; // флаг, что последним символом был разделитель

    while (true) {
        // Если дошли до конца строки
        if ($offset >= $length) {
            if ($endedWithDelimiter) {
                // После завершающего разделителя есть пустая строка
                if ($skip === 0) {
                    yield $startLine => '';
                } else {
                    $skip--; // пропускаем пустую строку
                }
            }
            break;
        }

        // Ищем разделитель строк (\R соответствует \n, \r\n, \r)
        if (\preg_match('/\R/', $content, $matches, \PREG_OFFSET_CAPTURE, $offset) === 1) {
            $pos      = $matches[0][1];
            $line     = \substr($content, $offset, $pos - $offset);
            $offset   = $pos + \strlen($matches[0][0]);

            if ($offset === $length) {
                $endedWithDelimiter = true;
            }

            // Обработка строки (пропуск или выдача)
            if ($skip > 0) {
                $skip--;
                continue; // строка пропущена
            }

            yield $startLine => $line;
            $startLine++;
        } else {
            // Больше разделителей нет – последняя строка (без завершающего перевода)
            $line = \substr($content, $offset);
            $offset = $length;

            if ($skip > 0) {
                $skip--;
                break; // последняя строка пропущена, больше ничего нет
            }

            yield $startLine => $line;
            $startLine++;
            break;
        }
    }
}
