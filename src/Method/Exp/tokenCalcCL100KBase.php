<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author https://token-calculator.net/token-calculator
 * @see https://huggingface.co/microsoft/Phi-3-small-8k-instruct/blob/main/cl100k_base.tiktoken
 * @psalm-import-type Return_tokenCalculator from \TypeExp
 * INFO скорость чуть ниже m2, но не требует RAM
 * INFO есть погрешность с скриптом на сайте
 * 
 * 
 * BPE cl100k_base
 * @return \Closure(string $text,bool $withoutArrayTokens):Return_tokenCalculator
 */
function tokenCalcCL100KBase(): \Closure
{
    $o = new class(__FUNCTION__) {
        /**
         * @var array<int,int>
         */
        public array $ranks;

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        function __construct(string $namespace)
        {
            // 100_256
            $this->ranks = \Inilim\Tool\Method\Other\__resource($namespace, 'cl100k_base.tiktoken.crc32.array');
            // $this->ranks = \json_decode(\file_get_contents('D:\projects\tools\files\resources\Exp\cl100k_base.tiktoken.crc32.json'), true);
        }

        /**
         * Кодирование текста в массив ID токенов
         */
        function encode(string $text, bool $withoutArrayTokens = false): array
        {
            $count = 0;
            $tokens = [];

            // 1. Разбиение текста регуляркой
            // Регулярное выражение для GPT-4 (cl100k_base)
            // Оно разбивает текст на слова, знаки препинания и пробелы специфичным образом
            // js "'s|'t|'re|'ve|'m|'ll|'d| ?\\p{L}+| ?\\p{N}+| ?[^\\s\\p{L}\\p{N}]+|\\s+(?!\\S)|\\s+"
            \preg_match_all(
                '/(?i:[sdmt]|ll|ve|re)|[^\r\n\p{L}\p{N}]?+\p{L}+|\p{N}{1,3}| ?[^\s\p{L}\p{N}]++[\r\n]*|\s*[\r\n]|\s+(?!\S)|\s+/u',
                $text,
                $matches
            );
            $matches = $matches[0];
            foreach ($matches as $pieceBytes) {

                // 2. Выполняем BPE слияние для этого куска
                $merged = $this->bytePairMerge($pieceBytes);

                foreach ($merged as $tokenBytes) {
                    // Если токен есть в базе рангов, берем его ID
                    $token = $this->ranks[\crc32($tokenBytes)] ?? null;
                    if ($token !== null) {
                        $count++;
                        if (!$withoutArrayTokens) {
                            $tokens[] = $token;
                        }
                    } else {
                        // dd('_dlkjwdk');
                        // Fallback для неизвестных байтов (редко бывает в cl100k)
                        // В реальной реализации здесь может быть логика для unk
                    }
                }
            }

            return [$tokens, $count];
        }

        /**
         * Алгоритм BPE: итеративное слияние пар байтов
         * @return string[]
         */
        function bytePairMerge(string $piece): array
        {
            // Разбиваем строку на массив отдельных символов (байтов)
            // В PHP строки это и есть байты, но нам нужен array для манипуляций
            $parts = \str_split($piece);
            /** @var string[] $parts */

            while (\count($parts) > 1) {
                $minRank = \PHP_INT_MAX;
                $minIdx = -1;

                // Ищем пару соседей с минимальным рангом
                for ($i = 0; $i < \count($parts) - 1; $i++) {
                    $pair = $parts[$i] . $parts[$i + 1];

                    $token = $this->ranks[\crc32($pair)] ?? null;
                    if ($token !== null) {
                        $rank = $token;
                        if ($rank < $minRank) {
                            $minRank = $rank;
                            $minIdx = $i;
                        }
                    }
                } // for

                // Если пар для слияния не нашли — выходим
                if ($minIdx === -1) {
                    break;
                }

                // Сливаем пару: parts[minIdx] + parts[minIdx+1]
                $parts[$minIdx] = $parts[$minIdx] . $parts[$minIdx + 1];
                // Удаляем следующий элемент (так как он слился с предыдущим)
                \array_splice($parts, $minIdx + 1, 1);
            } // while

            return $parts;
        }
    };

    return static function (string $text, bool $withoutArrayTokens = false) use ($o): array {
        [$tokens, $count] = $o->encode($text, $withoutArrayTokens);
        return [
            'tokens' => $tokens,
            'count'  => $count,
        ];
    };
}
