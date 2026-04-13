<?php

namespace Inilim\Tool;

class Obj
{
        /**
 * @author Inilim
 * 
 * @psalm-import-type Return_getCollectionThrowable from \TypeObj
 * 
 * @return Return_getCollectionThrowable
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
 * @author inilim
 * 
 * @desc Такой итератор реализует функциональность «заглядывания вперед и занад» (peek/lookback).
 * @template TValue
 * @template TKey
 *
 * @param iterable<TKey,TValue> $iterator
 * @return \Generator<TKey,array{before:TValue|null,current:TValue,after:TValue|null}>
 */
    static function peekBackIterator(iterable $iterator): Generator {}

        /**
 * @author inilim
 * 
 * @return \Generator<int,int>
 * @throws \ErrorException
 */
    static function rangeInt(int $start, int $end, int $step = 1): Generator {}

        /**
 * @template T of \Throwable
 * @param T $e
 * @return T
 */
    static function rewriteLocationException(\Throwable $e, string $file, int $line): object {}

        /**
 * @author inilim
 * @template T of \Throwable
 *
 * @param array $values
 * @param class-string<T>|T $classOrObj
 * @return T
 */
    static function sprintfException(string $format = '', array $values = [], $classOrObj = \Exception::class, array $args = []): Throwable {}

        /**
 * @author inilim
 *
 * @param array $values
 * @return \InvalidArgumentException
 */
    static function sprintfInvalidArgumentException(string $format = '', array $values = [], array $args = []): InvalidArgumentException {}

        /**
 * @author inilim
 *
 * @param array $values
 * @return \LogicException
 */
    static function sprintfLogicException(string $format = '', array $values = [], array $args = []): LogicException {}

        /**
 * @author inilim
 *
 * @param array $values
 * @return \RuntimeException
 */
    static function sprintfRuntimeException(string $format = '', array $values = [], array $args = []): RuntimeException {}

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
 * 
 * @template T of mixed
 * @param \Traversable<T> $obj
 * @return T[]
 */
    static function unpuckTraversableRecursive(\Traversable $obj): array {}

    }