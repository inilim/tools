<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Create a directory.
 * @todo tests
 * @author Inilim
 * @phpstan-import-type TYPEExceptionV1 from \TypeFile
 * @param array{path:string,mode?:int,recursive?:bool,force?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return array{result:?bool,exception:?TYPEExceptionV1}
 * @throws TYPEExceptionV1
 */
function makeDirViaArray(array $params): array
{
    return \Inilim\Tool\Method\FS\makeDir(
        $params['path'],
        $params['throw']         ?? false,
        $params['mode']          ?? 0755,
        $params['recursive']     ?? false,
        $params['force']         ?? false,
        $params['context']       ?? null,
        $params['contextParams'] ?? null,
    );
}
