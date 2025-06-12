<?php

namespace Inilim\Tool;

class Obj
{
        /**
 * @author Inilim
 * @phpstan-import-type TYPEgetCollectionThrowable from \TypeObj
 * @return TYPEgetCollectionThrowable
 */
    static function getCollectionThrowable(string $message = '', int $code = 0, ?int $line = null, ?string $file = null, ?\Throwable $previous = null) {}

        /**
 * @todo tests
 * @author inilim
 * @return \RecursiveIteratorIterator<string,\SplFileInfo>
 * @throws \InvalidArgumentException
 */
    static function iteratorFilesRecursive(string $pathToDir, bool $skipDots = true) {}

        /**
 * @template T of \Throwable
 * @param T $e
 * @return T
 */
    static function rewriteLocationException(\Throwable $e, string $file, int $line): object {}

        /**
 * @deprecated use Arr::from
 * @author mohammadrasoulasghari <https://github.com/mohammadrasoulasghari>
 * Convert a Traversable to an array, or return the original value if not Traversable.
 * @template T of mixed
 * @param T $value
 * @return ($value is \Traversable ? array : T)
 */
    static function toArrayIfTraversable($value) {}

        /**
 * @author inilim
 * @template T of mixed
 * @param \Traversable<T> $obj
 * @return T[]
 */
    static function unpuckTraversableRecursive(\Traversable $obj): array {}

    }