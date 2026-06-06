<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @author Inilim
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @param mixed $data
 * @param null|resource|array $context
 * @param null|array $contextParams
 * @return array{result:-1,exception:THROW_get_0}|array{result:int<0,max>,exception:null}
 * @throws THROW_get_0
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
        $d = \Inilim\Tool\Method\FS\makeDir($dir, false, $mode, true);
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
