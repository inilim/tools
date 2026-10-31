<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests
 * @author Inilim
 * analog function "file_put_contents"
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @see https://www.php.net/manual/ru/function.file-put-contents.php
 * 
 * @param array{filename:string,data:mixed,flags?:int,context?:resource,contextParams?:array,throw?:bool} $params
 * @return array{result:int<0,max>,exception:null}|array{result:-1,exception:TYPE_EXCEPTION_ITERATOR}
 * @throws TYPE_EXCEPTION_ITERATOR
 */
function putViaArray(array $params): array
{
    return \Inilim\Tool\Method\File\put(
        $params['filename'],
        $params['data'],
        $params['flags'] ?? 0,
        $params['throw'] ?? false,
        $params['context'] ?? null,
        $params['contextParams'] ?? null
    );
}
