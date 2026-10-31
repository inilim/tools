<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * Create a directory.
 * @todo tests
 * @author Inilim
 * 
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @param array{path:string,mode?:int,recursive?:bool,force?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return array{result:?bool,exception:?TYPE_EXCEPTION_ITERATOR}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
function makeDirViaArray(array $params): array
{
    return \Inilim\Tool\Method\FS\makeDir_v2(
        $params['path'],
        $params['mode']          ?? 0755,
        $params['recursive']     ?? false,
        $params['context']       ?? null,
        $params['contextParams'] ?? null,
        $params['force']         ?? false,
        $params['throw']         ?? false
    );
}
