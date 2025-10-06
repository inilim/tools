<?php

namespace Inilim\Tool;

class Exp
{
        /**
 * @author inilim
 * as implode();
 *
 * @param mixed[] $array
 * @param array<string,string|\Closure(mixed,string):string> $typeAs
 */
    static function arrJoin(array $array, string $separator = '', array $typeAs = []): string {}

        /**
 * @todo tests
 * Переводим буквенное представление столбца в числовое
 */
    static function excelColCharToNum(string $col): int {}

        /**
 * @author inilim
 * @todo tests
 * TODO переделать
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|array
 */
    static function excelExtractSheetToTmpFile($pathToFileOrZip, string $sheetId): ?array {}

        /**
 * @author deepseek
 * @todo tests
 * @return \Generator<int,string>
 */
    static function excelGenerateCellRange(string $range): Generator {}

        /**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @param string $sheetId id find from Exp::excelGetSheetsInfo()
 * @return null|resource
 */
    static function excelGetResourceSheetById($pathToFileOrZip, string $sheetId) {}

        /**
 * @psalm-import-type Param_1_excelGetSheetsInfo from \TypeExp
 * @author inilim
 * @todo tests
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|Param_1_excelGetSheetsInfo[]
 */
    static function excelGetSheetsInfo($pathToFileOrZip): ?array {}

        /**
 * INFO быстрый парсинг, но больше потребление памяти
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Cell_excelReadCellsBySheetId from \TypeExp
 * @ext dom zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|\Generator<int,Cell_excelReadCellsBySheetId>;
 */
    static function excelReadCellsBySheetId($pathToFileOrZip, string $sheetId, int $offset = 0): ?Generator {}

        /**
 * INFO Используем расширение xmlreader, не потребляет память, но скорость хуже по сравнению с excelReadCellsBySheetId()
 * INFO PHP7.4 100_000 записей примерно 2 минуты PHP8.4 1.5 минуты
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @psalm-import-type Cell_excelReadCellsBySheetId_m2 from \TypeExp
 * @psalm-import-type DataCell_excelReadCellsBySheetId_m2 from \TypeExp
 * @ext xmlreader zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|\Generator<int,Cell_excelReadCellsBySheetId_m2>;
 */
    static function excelReadCellsBySheetId_m2($pathToFileOrZip, string $sheetId, int $offset = 0): ?Generator {}

        /**
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 */
    static function excelRemoveTmpFiles($pathToFileOrZip): int {}

        /**
 * @author stevebauman <https://github.com/stevebauman>
 * Extract values from the haystack using the given template pattern.
 * @return array<string,string>
 */
    static function extract(string $haystack, string $pattern) {}

        /**
 * @author shaedrich <https://github.com/shaedrich>
 * Formats the input string accodring to the pattern passed in.
 *
 * @param  string  $string  the input string
 * @param  string  $pattern  asterisks will be replaced with the character
 *                           at the respective position of the input string
 *                           while other characters will put inserted as
 *                           is into the output string
 */
    static function formatByPattern(string $string, string $pattern) {}

        /**
 * @author nette/utils
 * @author inilim
 * Looks for a string from possibilities that is most similar to value, but not the same (for 8-bit encoding).
 * @param  string[]  $possibilities
 * @return string[]
 */
    static function getSuggestionLevenshtein(array $possibilities, string $value) {}

        /**
 * Хеширование файла на основе размера файла, начала содержимого и конца, экспериментальная альтернатива функции hash_file, дабы ускорить хеширование больших файлов
 * @author inilim
 * @return string
 * @throws \InvalidArgumentException
 * @throws \Exception
 */
    static function hashFile(string $algo, string $pathToFile, int $byteStart = 1024, int $byteEnd = 1024, bool $binary = false) {}

        /**
 * @author guzzle/guzzle
 * @author inilim
 * Parses an array of header lines into an associative array of headers.
 *
 * @param iterable<string> $lines Header lines array of strings in the following
 *                        format: "Name: Value"
 * 
 * @return array<string,string[]>
 */
    static function headersFromLines(iterable $lines): array {}

        /**
 * @author Ashot1995 <https://github.com/Ashot1995>
 * @author inilim
 * @param  string  $value
 * @param  string  $separator
 * @return string
 */
    static function initials(string $value, string $separator = '') {}

        /**
 * @author princejohnsantillan <https://github.com/princejohnsantillan>
 * Interpolate placeholders in a string with mapped values.
 * @param  array<string,string>  $map
 */
    static function interpolate(string $string, array $map, bool $preserveMissing = true, string $pattern = '/{{\s*(\w+)\s*}}/'): string {}

        /**
 * @todo tests
 * @author youkidearitai <https://github.com/youkidearitai>
 * Implementation levenshtein distance algorithm.
 *
 * @param string $str1 The first string.
 * @param string $str2 The second string.
 *
 * @return int The Levenshtein distance between the two strings.
 */
    static function mbLevenshtein(string $str1, string $str2): int {}

        /**
 * @author inilim
 * @todo tests
 * @psalm-import-type Param_1_normalizeHeaders from \TypeExp
 * @psalm-import-type Return_normalizeHeaders from \TypeExp
 * 
 * @param Param_1_normalizeHeaders $headers
 * @return Return_normalizeHeaders
 */
    static function normalizeHeaders(array $headers): array {}

        /**
 * @author guzzle/guzzle
 * Parses the given proxy URL to make it compatible with the format PHP's stream context expects.
 * 
 * @return array{proxy:string,auth:null|string}
 */
    static function parseProxy(string $url): array {}

        /**
 * @author inilim
 *
 * @param string[] $array
 */
    static function stringContainsInArray(array $array, string $needle, bool $ignoreCase = false): bool {}

        /**
 * @author inilim
 *
 * @param string[] $array
 */
    static function stringEndsWithInArray(array $array, string $needle, bool $ignoreCase = false): bool {}

        /**
 * @author inilim
 *
 * @param string[] $array
 */
    static function stringStartsWithInArray(array $array, string $needle, bool $ignoreCase = false): bool {}

    }