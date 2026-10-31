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
    static function arrJoin(array $array, string $separator = '', array $typeAs = []): string {
        throw new \Exception;
    }

        /**
 * @author inilim
 */
    static function closeResObjJsonSqlite(object $value): bool {
        throw new \Exception;
    }

        /**
 * @author inilim
 * 
 * @return string[]
 */
    static function defineLang(string $text): array {
        throw new \Exception;
    }

        /**
 * @todo tests
 * Переводим буквенное представление столбца в числовое
 */
    static function excelColCharToNum(string $col): int {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 * TODO переделать
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|array
 */
    static function excelExtractSheetToTmpFile($pathToFileOrZip, string $sheetId): ?array {
        throw new \Exception;
    }

        /**
 * @author deepseek
 * @todo tests
 * @return \Generator<int,string>
 */
    static function excelGenerateCellRange(string $range): Generator {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @param string $sheetId id find from Exp::excelGetSheetsInfo()
 * @return null|resource
 */
    static function excelGetResourceSheetById($pathToFileOrZip, string $sheetId) {
        throw new \Exception;
    }

        /**
 * @psalm-import-type Param_1_excelGetSheetsInfo from \TypeExp
 * @author inilim
 * @todo tests
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|Param_1_excelGetSheetsInfo[]
 */
    static function excelGetSheetsInfo($pathToFileOrZip): ?array {
        throw new \Exception;
    }

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
    static function excelReadCellsBySheetId($pathToFileOrZip, string $sheetId, int $offset = 0): ?Generator {
        throw new \Exception;
    }

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
    static function excelReadCellsBySheetId_m2($pathToFileOrZip, string $sheetId, int $offset = 0): ?Generator {
        throw new \Exception;
    }

        /**
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 */
    static function excelRemoveTmpFiles($pathToFileOrZip): int {
        throw new \Exception;
    }

        /**
 * @author stevebauman <https://github.com/stevebauman>
 * Extract values from the haystack using the given template pattern.
 * @return array<string,string>
 */
    static function extract(string $haystack, string $pattern) {
        throw new \Exception;
    }

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
    static function formatByPattern(string $string, string $pattern) {
        throw new \Exception;
    }

        /**
 * @author nette/utils
 * @author inilim
 * Looks for a string from possibilities that is most similar to value, but not the same (for 8-bit encoding).
 * @param  string[]  $possibilities
 * @return string[]
 */
    static function getSuggestionLevenshtein(array $possibilities, string $value) {
        throw new \Exception;
    }

        /**
 * Хеширование файла на основе размера файла, начала содержимого и конца, экспериментальная альтернатива функции hash_file, дабы ускорить хеширование больших файлов
 * @author inilim
 * @return string
 * @throws \InvalidArgumentException
 * @throws \Exception
 */
    static function hashFile(string $algo, string $pathToFile, int $byteStart = 1024, int $byteEnd = 1024, bool $binary = false) {
        throw new \Exception;
    }

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
    static function headersFromLines(iterable $lines): array {
        throw new \Exception;
    }

        /**
 * @author Ashot1995 <https://github.com/Ashot1995>
 * @author inilim
 * @ext mbstring
 * @param  string  $value
 * @param  string  $separator
 * @return string
 */
    static function initials(string $value, string $separator = '') {
        throw new \Exception;
    }

        /**
 * @author princejohnsantillan <https://github.com/princejohnsantillan>
 * Interpolate placeholders in a string with mapped values.
 * @param  array<string,string>  $map
 */
    static function interpolate(string $string, array $map, bool $preserveMissing = true, string $pattern = '/{{\s*(\w+)\s*}}/'): string {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @psalm-assert-if-true object $value
 * @phpstan-assert-if-true object $value
 * проверяет что обьект является ресурсным для методов ***ViaSqlite();
 * @param mixed $value
 */
    static function isResObjJsonSqlite($value): bool {
        throw new \Exception;
    }

        /**
 * Значительно экономит ОЗУ, но медленее чем json_decode() minimum sqlite version 3.42.0
 * @see https://sqlite.org/json1.html#jerr
 * @author inilim
 * @todo tests
 * @ext PDO pdo_sqlite
 */
    static function jsonErrorPositionViaSqlite(string $json): ?int {
        throw new \Exception;
    }

        /**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#jex
 * @ext PDO pdo_sqlite
 * @param string|string[] $pattern see https://sqlite.org/json1.html#jex
 * @return mixed
 * @throws \InvalidArgumentException
 */
    static function jsonExtractViaSqlite(string $json, $pattern) {
        throw new \Exception;
    }

        /**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#jarraylen
 * @ext PDO pdo_sqlite
 * @param string $pattern see https://sqlite.org/json1.html#jarraylen
 * @throws \InvalidArgumentException
 */
    static function jsonLengthViaSqlite(string $json, ?string $pattern = null): ?int {
        throw new \Exception;
    }

        /**
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#the_json_valid_function
 * @author inilim
 * @param int $flags 1  - is RFC-8259 JSON text | 2  - is JSON5 text | 4  - is probably JSONB | 5  - is RFC-8259 JSON text or JSONB | 6  - is JSON5 text or JSONB ← This is probably the value you want | 8  - is strictly conforming JSONB | 9  - is RFC-8259 or strictly conforming JSONB | 10 - is JSON5 or strictly conforming JSONB
 * @ext PDO pdo_sqlite
 */
    static function jsonValidateViaSqlite(string $json, int $flags = 1): bool {
        throw new \Exception;
    }

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
    static function jsonWalkRecursiveViaSqlite(string $json, callable $callback, ?int $limit = null, $valueBreak = false, array $types = []): bool {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author youkidearitai <https://github.com/youkidearitai>
 * Implementation levenshtein distance algorithm.
 *
 * @ext mbstring
 * @param string $str1 The first string.
 * @param string $str2 The second string.
 *
 * @return int The Levenshtein distance between the two strings.
 */
    static function mbLevenshtein(string $str1, string $str2): int {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 * @psalm-import-type Param_1_normalizeHeaders from \TypeExp
 * @psalm-import-type Return_normalizeHeaders from \TypeExp
 * 
 * @param Param_1_normalizeHeaders $headers
 * @return Return_normalizeHeaders
 */
    static function normalizeHeaders(array $headers): array {
        throw new \Exception;
    }

        /**
 * @author inilim
 * Создает временный файл sqlite в котором содержится json из файла $pathToFile, для последующих вызовов связанных функций
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @todo tests
 * @param resource|string $source file or resource
 * @ext PDO pdo_sqlite
 * @throws \InvalidArgumentException
 */
    static function openJsonViaSqlite($source): ?object {
        throw new \Exception;
    }

        /**
 * @author guzzle/guzzle
 * Parses the given proxy URL to make it compatible with the format PHP's stream context expects.
 * 
 * @return array{proxy:string,auth:null|string}
 */
    static function parseProxy(string $url): array {
        throw new \Exception;
    }

        /**
 * @author inilim
 *
 * @param string[] $array
 */
    static function stringContainsInArray(array $array, string $needle, bool $ignoreCase = false): bool {
        throw new \Exception;
    }

        /**
 * @author inilim
 *
 * @param string[] $array
 */
    static function stringEndsWithInArray(array $array, string $needle, bool $ignoreCase = false): bool {
        throw new \Exception;
    }

        /**
 * @author inilim
 *
 * @param string[] $array
 */
    static function stringStartsWithInArray(array $array, string $needle, bool $ignoreCase = false): bool {
        throw new \Exception;
    }

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
    static function tokenCalcCL100KBase(): Closure {
        throw new \Exception;
    }

        /**
 * Binary vector to array
 * @return float[]
 */
    static function vec_binVecToArray(string $vector): array {
        throw new \Exception;
    }

        /**
 * Cosine similarity on array vectors.
 * @param float[] $vectorA
 * @param float[] $vectorB
 */
    static function vec_cosineSimilarity(array $vectorA, array $vectorB): float {
        throw new \Exception;
    }

        /**
 * Cosine similarity on binary vectors.
 */
    static function vec_cosineSimilarityBin(string $binVectorA, string $binVectorB): float {
        throw new \Exception;
    }

        /**
 * @param float[] $vectorA
 * @param float[] $vectorB
 */
    static function vec_dotProduct(array $vectorA, array $vectorB): float {
        throw new \Exception;
    }

        /**
 * Normalized vector to binary.
 * @param float[] $vector
 */
    static function vec_normalVecToBin(array $vector): string {
        throw new \Exception;
    }

        /**
 * Normalize a vector.
 * @param float[] $vector
 * @return array{0:float[],1:float}
 */
    static function vec_normalize(array $vector): array {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 * 
 * commands "get:file" "get:count" "get:resource" "end"|"close"|"finish"
 * 
 * @param ?string $dir default sys_get_temp_dir()
 * @return null|\Closure(mixed $value,?string $command):false|int|resource|string
 */
    static function writeContentToNewFile(?string $dir = null): ?Closure {
        throw new \Exception;
    }

    }