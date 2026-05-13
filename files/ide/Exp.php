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
 * @author inilim
 */
    static function closeResObjJsonSqlite(object $value): bool {}

        /**
 * @author inilim
 * 
 * @return string[]
 */
    static function defineLang(string $text): array {}

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
 * @author inilim
 * @psalm-assert-if-true object $value
 * @phpstan-assert-if-true object $value
 * проверяет что обьект является ресурсным для методов ***ViaSqlite();
 * @param mixed $value
 */
    static function isResObjJsonSqlite($value): bool {}

        /**
 * Значительно экономит ОЗУ, но медленее чем json_decode() minimum sqlite version 3.42.0
 * @see https://sqlite.org/json1.html#jerr
 * @author inilim
 * @todo tests
 * @ext PDO pdo_sqlite
 */
    static function jsonErrorPositionViaSqlite(string $json): ?int {}

        /**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#jex
 * @ext PDO pdo_sqlite
 * @param string|string[] $pattern see https://sqlite.org/json1.html#jex
 * @return mixed
 * @throws \InvalidArgumentException
 */
    static function jsonExtractViaSqlite(string $json, $pattern) {}

        /**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#jarraylen
 * @ext PDO pdo_sqlite
 * @param string $pattern see https://sqlite.org/json1.html#jarraylen
 * @throws \InvalidArgumentException
 */
    static function jsonLengthViaSqlite(string $json, ?string $pattern = null): ?int {}

        /**
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#the_json_valid_function
 * @author inilim
 * @param int $flags 1  - is RFC-8259 JSON text | 2  - is JSON5 text | 4  - is probably JSONB | 5  - is RFC-8259 JSON text or JSONB | 6  - is JSON5 text or JSONB ← This is probably the value you want | 8  - is strictly conforming JSONB | 9  - is RFC-8259 or strictly conforming JSONB | 10 - is JSON5 or strictly conforming JSONB
 * @ext PDO pdo_sqlite
 */
    static function jsonValidateViaSqlite(string $json, int $flags = 1): bool {}

        /**
 * @author inilim
 * INFO win. если json строка занимает 5mb, то парсинг json через sqlite будет стоить 12-15mb суммарно.
 * INFO win. в php84 отслеживание ОЗУ что потребляет sqlite php более не отслеживает!
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @ext PDO pdo_sqlite
 * @template B of mixed
 * @param string $json
 * @param null|positive-int $limit
 * @param ('object'|'array'|'int'|'string'|'float'|'bool'|'null')[] $types
 * @param B $valueBreak
 * @param callable(string|int $key, string|int|float|null|bool $value, string $type, string $fullkey):B $callback
 */
    static function jsonWalkRecursiveViaSqlite(string $json, callable $callback, ?int $limit = null, $valueBreak = false, array $types = []): bool {}

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
 * @author inilim
 * Создает временный файл sqlite в котором содержится json из файла $pathToFile, для последующих вызовов связанных функций
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @todo tests
 * @param resource|string $source file or resource
 * @ext PDO pdo_sqlite
 * @throws \InvalidArgumentException
 */
    static function openJsonViaSqlite($source): ?object {}

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
    static function tokenCalcCL100KBase(): Closure {}

        /**
 * Binary vector to array
 * @return float[]
 */
    static function vec_binVecToArray(string $vector): array {}

        /**
 * Cosine similarity on array vectors.
 * @param float[] $vectorA
 * @param float[] $vectorB
 */
    static function vec_cosineSimilarity(array $vectorA, array $vectorB): float {}

        /**
 * Cosine similarity on binary vectors.
 */
    static function vec_cosineSimilarityBin(string $binVectorA, string $binVectorB): float {}

        /**
 * @param float[] $vectorA
 * @param float[] $vectorB
 */
    static function vec_dotProduct(array $vectorA, array $vectorB): float {}

        /**
 * Normalized vector to binary.
 * @param float[] $vector
 */
    static function vec_normalVecToBin(array $vector): string {}

        /**
 * Normalize a vector.
 * @param float[] $vector
 * @return array{0:float[],1:float}
 */
    static function vec_normalize(array $vector): array {}

        /**
 * @author inilim
 * @todo tests
 * 
 * commands "get:file" "get:count" "get:resource" "end"|"close"|"finish"
 * 
 * @param ?string $dir default sys_get_temp_dir()
 * @return null|\Closure(mixed $value,?string $command):false|int|resource|string
 */
    static function writeContentToNewFile(?string $dir = null): ?Closure {}

    }