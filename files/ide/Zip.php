<?php

namespace Inilim\Tool;

class Zip
{
        /**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @param callable(ZipStatItem):bool $predicate
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
    static function findAllByCallable($pathToFileOrZip, callable $predicate): array {}

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
 * @param callable(ZipStatItem):bool $predicate
 * @throws \InvalidArgumentException
 * @return null|ZipStatItem
 */
    static function findFirstByCallable($pathToFileOrZip, callable $predicate): ?array {}

        /**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @param callable(ZipStatItem):bool $predicate
 * @return null|resource
 */
    static function findFirstResourceByCallable($pathToFileOrZip, callable $predicate) {}

        /**
 * @ext zip
 * @todo tests
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 */
    static function getObjFrom($pathToFileOrZip): ZipArchive {}

        /**
 * @todo tests
 * @return null|resource
 */
    static function getResourceByIdx(\ZipArchive $zip, int $idx) {}

        /**
 * @ext zip
 * \ZipArchive::open()
 * @see https://www.php.net/manual/en/ziparchive.open.php
 */
    static function open(string $filename, int $flags = 0): ?ZipArchive {}

        /**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @link https://php.net/manual/en/ziparchive.statindex.php
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @throws \InvalidArgumentException
 * @return ZipStatItem[]
 */
    static function scan($pathToFileOrZip): array {}

        /**
 * @psalm-import-type ZipStatItem from \TypeZip
 * @todo tests
 * @link https://php.net/manual/en/ziparchive.statindex.php
 * @param string|\ZipArchive $pathToFileOrZip path to file-zip OR ZipArchive object
 * @return \Generator<int,ZipStatItem>
 * @throws \InvalidArgumentException
 */
    static function scanAsGenerator($pathToFileOrZip): Generator {}

    }