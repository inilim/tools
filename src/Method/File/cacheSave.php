<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @param mixed $value
 * @param ?int $lifetime default 1 year in seconds
 * @return array{result:bool,exception:null|\ErrorException}
 * @throws \ErrorException
 */
function cacheSave(string $pathToFile, $value, ?int $lifetime = null, bool $throw = false)
{
    try {
        \Inilim\Tool\Method\Other\tryCallWithErrHandler(
            // [Callable]
            static function ($obj) use ($pathToFile, $value, $lifetime) {

                foreach (['fopen', 'fopen2'] as $step) {
                    $obj->tmp  = \dirname($pathToFile) . '/' . \strtr(\base64_encode(\random_bytes(8)), '/', '-');
                    $obj->step = $step;
                    if ($h = \fopen($obj->tmp, 'x')) break;
                }

                /** @var false|resource $h */

                if ($h === false) {
                    \trigger_error('', \E_USER_ERROR);
                }

                // 1 year in seconds
                $ser       = (($lifetime ?? 31_556_952) + \time()) . "\n" . \serialize($value);
                $obj->step = 'fwrite';
                \fwrite($h, $ser);
                $obj->step = 'fclose';
                \fclose($h);

                // ---------------------------------------------
                // use copy() instead of rename() on Windows
                // On Windows depending on the PHP version rename() can fail if the target
                // file is being executed. Since the source file is not used by another
                // process using copy() instead should be safe to be used.
                // @see https://github.com/symfony/cache/commit/4f50cdc2a63a4f00cdce3963561a4817fac1f087
                // ---------------------------------------------
                $unlink = false;
                if ('\\' === \DIRECTORY_SEPARATOR) {
                    $obj->step = 'copy';
                    $unlink = true;
                    $status = \copy($obj->tmp, $pathToFile);
                } else {
                    $obj->step = 'rename';
                    $status = \rename($obj->tmp, $pathToFile);
                }

                if (!$status || $unlink) {
                    $obj->step = 'unlink';
                    \unlink($obj->tmp);
                    \clearstatcache(false, $obj->tmp);
                }
            },
            // [Handler]
            static function ($type, $message, $file, $line, $context) {
                $obj = $context['obj'];
                if ($obj->step === 'fopen') {
                    if (!\Inilim\Tool\Method\PF\str_contains($message, 'File exists')) {
                        throw new \ErrorException($message, 0, $type);
                    }
                } elseif (\in_array($obj->step, ['fwrite', 'fclose', 'rename', 'copy'], true)) {
                    @\unlink($obj->tmp);
                    \clearstatcache(false, $obj->tmp);
                    throw new \ErrorException($message, 0, $type);
                } else {
                    throw new \ErrorException($message, 0, $type);
                }
            }
        );
    } catch (\ErrorException $e) {
        if ($throw) {
            throw $e;
        }
        return [
            'result'    => false,
            'exception' => $e,
        ];
    }
    return [
        'result'    => true,
        'exception' => null,
    ];
}
















// function write73(string $file, string $data, ?int $expiresAt = null): bool
// {
//     $unlink = false;
//     set_error_handler(static fn($type, $message, $file, $line) => throw new \ErrorException($message, 0, $type, $file, $line));
//     try {
//         $tmp = $this->directory . $this->tmpSuffix ??= str_replace('/', '-', base64_encode(random_bytes(6)));
//         try {
//             $h = fopen($tmp, 'x');
//         } catch (\ErrorException $e) {
//             if (!str_contains($e->getMessage(), 'File exists')) {
//                 throw $e;
//             }

//             $tmp = $this->directory . $this->tmpSuffix = str_replace('/', '-', base64_encode(random_bytes(6)));
//             $h = fopen($tmp, 'x');
//         }
//         fwrite($h, $data);
//         fclose($h);
//         $unlink = true;

//         if ($expiresAt !== null) {
//             touch($tmp, $expiresAt ?: time() + 31556952); // 1 year in seconds
//         }

//         if ('\\' === \DIRECTORY_SEPARATOR) {
//             $success = copy($tmp, $file);
//         } else {
//             $success = rename($tmp, $file);
//             $unlink = !$success;
//         }

//         return $success;
//     } finally {
//         restore_error_handler();

//         if ($unlink) {
//             @unlink($tmp);
//         }
//     }
// }
