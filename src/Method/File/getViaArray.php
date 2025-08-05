<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * 
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @psalm-import-type Return_get from \TypeFile
 * 
 * @param array{pathToFile:string,offset?:int,lenght?:int,useIncludePath?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return Return_get
 * @throws THROW_get_0
 */
function getViaArray(array $params): array
{
    return \Inilim\Tool\Method\File\get(
        $params['pathToFile'],
        $params['offset']         ?? 0,
        $params['length']         ?? null,
        $params['useIncludePath'] ?? false,
        $params['throw']          ?? false,
        $params['context']        ?? null,
        $params['contextParams']  ?? null
    );
}
