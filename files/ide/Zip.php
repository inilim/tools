<?php

namespace Inilim\Tool;

class Zip
{
        /**
 * @author inilim
 * @todo tests
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @psalm-import-type Return_extractByCallable from \TypeZip
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param ?string $dir default sys_get_temp_dir()
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @return ?Return_extractByCallable
 */
    static function extractByCallable($pathToFileOrZip, callable $predicate, ?string $dir = null): ?array {
        throw new \Exception;
    }

        /**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @throws \InvalidArgumentException
 * @return TYPE_ZIP_STAT_ITEM[]
 */
    static function findAllByCallable($pathToFileOrZip, callable $predicate): ?array {
        throw new \Exception;
    }

        /**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @param mixed $valueBreak
 * @throws \InvalidArgumentException
 * @return TYPE_ZIP_STAT_ITEM[]
 */
    static function findByFilter($pathToFileOrZip, callable $predicate, $valueBreak = null): ?array {
        throw new \Exception;
    }

        /**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $source path to file-zip OR ZipArchive object
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @param mixed $valueBreak
 * @throws \InvalidArgumentException
 * @return \Generator<int,TYPE_ZIP_STAT_ITEM>
 */
    static function findByFilterAsGenerator($source, callable $predicate, $valueBreak = null): ?Generator {
        throw new \Exception;
    }

        /**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $source path to file-zip OR ZipArchive object
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @throws \InvalidArgumentException
 * @return ?TYPE_ZIP_STAT_ITEM
 */
    static function findFirstByCallable($source, callable $predicate): ?array {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @todo tests
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @ext zip
 * @param string|\ZipArchive $source
 * @param callable(TYPE_ZIP_STAT_ITEM):bool $predicate
 * @return null|resource
 */
    static function findFirstResourceByCallable($source, callable $predicate) {
        throw new \Exception;
    }

        /**
 * @ext zip
 * @todo tests
 * @param string|\ZipArchive $source path to file-zip OR ZipArchive object
 * @return ?\ZipArchive
 */
    static function getObjFrom($source): ?object {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @return null|resource
 */
    static function getResourceByIdx(\ZipArchive $zip, int $idx) {
        throw new \Exception;
    }

        /**
 * @ext zip
 * \ZipArchive::open()
 * @see https://www.php.net/manual/en/ziparchive.open.php
 */
    static function open(string $filename, int $flags = 0): ?ZipArchive {
        throw new \Exception;
    }

        /**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @link https://php.net/manual/en/ziparchive.statindex.php
 * @param string|\ZipArchive $source path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 * @return TYPE_ZIP_STAT_ITEM[]
 */
    static function scan($source): ?array {
        throw new \Exception;
    }

        /**
 * @psalm-import-type TYPE_ZIP_STAT_ITEM from \TypeZip
 * @todo tests
 * @link https://php.net/manual/en/ziparchive.statindex.php
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @return ?\Generator<int,TYPE_ZIP_STAT_ITEM>
 * @throws \InvalidArgumentException
 * @ext zip
 */
    static function scanAsGenerator($pathToFileOrZip): ?Generator {
        throw new \Exception;
    }

    }