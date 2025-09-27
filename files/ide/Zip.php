<?php

namespace Inilim\Tool;

class Zip
{
        /**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(ZipStatItem):bool $predicate
 * @param mixed $valueBreak
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
    static function findByFilter($pathToFileOrZip, callable $predicate, $valueBreak = null): array {}

        /**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(ZipStatItem):bool $predicate
 * @param mixed $valueBreak
 * @throws \InvalidArgumentException
 * @return \Generator<int,ZipStatItem>
 */
    static function findByFilterAsGenerator($pathToFileOrZip, callable $predicate, $valueBreak = null): Generator {}

        /**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
    static function findByNameFile($pathToFileOrZip, string $fileName, bool $partialMatch = false, bool $ignoreCase = false): array {}

        /**
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 */
    static function getObjFrom($pathToFileOrZip): ZipArchive {}

        /**
 */
    static function open(string $filename, int $flags = 0): ?ZipArchive {}

        /**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
    static function scan($pathToFileOrZip): array {}

        /**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @return \Generator<int,ZipStatItem>
 * @throws \InvalidArgumentException
 */
    static function scanAsGenerator($pathToFileOrZip): Generator {}

    }