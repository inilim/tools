<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the contents of a file as serialize.
 * @todo tests
 * @author inilim
 * @param array{pathToFile:string,options?:int,lock?:bool,throw?:bool,default?:mixed} $params
 * @return mixed
 * @phpstan-import-type TYPEExceptionV1 from \TypeFile
 * @throws TYPEExceptionV1
 */
function unserializeAsArray(array $params)
{
    return \Inilim\Tool\Method\File\unserialize(
        $params['pathToFile'],
        $params['options'] ?? [],
        $params['lock']    ?? false,
        $params['throw']   ?? false,
        $params['default'] ?? null,
    );
}
