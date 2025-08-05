<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the contents of a file as decoded JSON.
 * @param array{pathToFile:string,flags?:int,lock?:bool,throw?:bool,default?:mixed} $params
 * @return mixed
 * @psalm-import-type THROW_get_0 from \TypeFile
 * @throws THROW_get_0
 * @throws \JsonException
 */
function jsonViaArray(array $params)
{
    return \Inilim\Tool\Method\File\json(
        $params['pathToFile'],
        $params['flags']   ?? 0,
        $params['lock']    ?? false,
        $params['throw']   ?? false,
        $params['default'] ?? null,
    );
}
