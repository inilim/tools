<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @template TValue of string
 * @template TKey of string|int
 * @param TValue|iterable<TKey,TValue> $pathToFile
 * @return array{result:($pathToFile is iterable ? array<TKey,mixed> : mixed),exception:null|\Throwable}
 */
function cacheRead($pathToFile, bool $throw = false, bool $abortIfErr = false)
{
    $args = [
        'result'     => [],
        'once'       => false,
        'exception'  => null,
        'curFile'    => null,
        'abortIfErr' => $abortIfErr,
    ];
    if (\is_string($pathToFile)) {
        $args['once'] = true;
        $pathToFile   = [$pathToFile];
    }
    $args['files'] = $pathToFile;

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        // [Callable]
        static function () use (&$args) {
            foreach ($args['files'] as $idx => $file) {
                $args['curFile']      = $file;
                $args['result'][$idx] = null;
                try {
                    // ---------------------------------------------
                    // Procedure
                    // ---------------------------------------------
                    if (!\is_file($file) || !$h = @\fopen($file, 'r')) {
                        continue; // return null;
                    }
                    if (($expiresAt = (int) \fgets($h)) && \time() >= $expiresAt) {
                        \fclose($h);
                        @\unlink($file);
                        \clearstatcache(false, $file);
                        continue; // return null;
                    }

                    $data = \stream_get_contents($h);
                    if ($data === false) $data = '';
                    \fclose($h);

                    if ('' === $data) {
                        continue; // return null;
                    }
                    if ('b:0;' === $data) {
                        $args['result'][$idx] = false;
                        continue;
                    }
                    $data = \unserialize($data);
                    if ($data === false) {
                        continue; // return null;
                    }
                    $args['result'][$idx] = $data;
                    continue;
                    // ---------------------------------------------
                    // end Procedure
                    // ---------------------------------------------
                } catch (\ErrorException $e) {
                    $args['exception'] ??= \Inilim\Tool\Method\Obj\getCollectionThrowable();
                    $args['exception'][] = $e;
                    if ($args['abortIfErr']) {
                        break;
                    }
                }
            } // end foreach
        },
        // [Handler]
        static function ($type, $message) use (&$args) {
            $context = \func_get_arg(4);
            // Пропускаем ошибки которые подавляем
            if ($context['isSuppress']) {
                return;
            }
            throw new \ErrorException($message, 0, $type, $args['curFile']);
        }
    );

    // ---------------------------------------------
    // Finish
    // ---------------------------------------------

    if ($throw && $args['exception']) {
        throw $args['exception'];
    }

    if ($args['once']) {
        return [
            'result'    => $args['result'][0],
            'exception' => $args['exception'],
        ];
    }
    return [
        'result'    => $args['result'],
        'exception' => $args['exception'],
    ];
}












// function doFetch(array $ids): iterable
// {
//     $values = [];
//     $now = time();

//     foreach ($ids as $id) {
//         $file = $this->getFile($id);
//         if (!is_file($file) || !$h = @fopen($file, 'r')) {
//             continue;
//         }
//         if (($expiresAt = (int) fgets($h)) && $now >= $expiresAt) {
//             fclose($h);
//             @unlink($file);
//         } else {
//             $i = rawurldecode(rtrim(fgets($h)));
//             $value = stream_get_contents($h);
//             fclose($h);
//             if ($i === $id) {
//                 $values[$id] = $this->marshaller->unmarshall($value);
//             }
//         }
//     }

//     return $values;
// }
