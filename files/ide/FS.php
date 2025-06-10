<?php

namespace Inilim\Tool;

class FS
{
        /**
 * Get or set UNIX mode of a file or directory.
 * @return mixed
 */
    static function chmod(string $path, ?int $mode = null) {}

        /**
 * Determine if a file or directory exists.
 */
    static function exists(string $path): bool {}

        /**
 * Gigabytes to Bytes
 */
    static function gbToBytes(int $gb): int {}

        /**
 * Kilobytes to Bytes
 */
    static function kbToBytes(int $kb): int {}

        /**
 * Megabytes to Bytes
 */
    static function mbToBytes(int $mb): int {}

        /**
 * Determine if a file or directory is missing.
 */
    static function missing(string $path): bool {}

        /**
 * Move a file to a new location.
 */
    static function move(string $path, string $target): bool {}

    }