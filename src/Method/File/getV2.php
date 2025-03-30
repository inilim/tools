<?php

namespace Inilim\Tool\Method\File;

/**
 * @author Inilim
 * analog function "file_get_contents"
 * @phpstan-import-type get_throw from \File
 * @see https://www.php.net/manual/ru/function.file-get-contents.php
 * @param array{filename:string,offset?:int,lenght?:int,useIncludePath?:bool,throw?:bool,context?:resource|array,contextParams?:array} $params
 * @return array{result:string|null,exception:null|get_throw}
 * @throws get_throw
 */
function getV2(array $params)
{
    return \Inilim\Tool\Method\File\get(
        $params['filename'],
        $params['offset']         ?? 0,
        $params['length']         ?? null,
        $params['useIncludePath'] ?? false,
        $params['throw']          ?? false,
        $params['context']        ?? null,
        $params['contextParams']  ?? null
    );
}
