<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @author Inilim
 * analog function "file_get_contents"
 * @phpstan-import-type TYPEExceptionV1 from \TypeFile
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * @param array{pathToFile:string,offset?:int,lenght?:int,useIncludePath?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return array{result:string|null,exception:null|TYPEExceptionV1}
 * @throws TYPEExceptionV1
 */
function getViaArray(array $params)
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
