<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @author Inilim
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @param mixed $data
 * @param null|resource|array $context
 * @param null|array $contextParams
 * @return array{result:-1,exception:TYPE_EXCEPTION_ITERATOR}|array{result:int<0,max>,exception:null}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
function ensurePut(
    string $filename,
    $data,
    int $flags            = 0,
    bool $throw           = false,
    int $mode             = 0755,
    $context              = null,
    ?array $contextParams = null
): array {
    $dir = \dirname($filename);
    $d   = null;
    if (!\Inilim\Tool\Method\FS\isDir($dir)) {
        $d = \Inilim\Tool\Method\FS\makeDir_v2($dir, $mode, true);
    }

    $f =  \Inilim\Tool\Method\File\put(
        $filename,
        $data,
        $flags,
        false,
        $context,
        $contextParams
    );

    if ($d === null) {
        return $f;
    }

    if ($f['exception'] && $d['exception']) {
        $ce = \Inilim\Tool\Method\Obj\getCollectionThrowable('File::ensurePut(...)');
        foreach ([...$d['exception'], ...$f['exception']] as $e) {
            /** @var \Throwable $e */
            $ce[] = $e;
        }
        if ($throw) {
            throw $ce;
        }
        $f['exception'] = $ce;
    }

    return $f;
}
