<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @param resource $resource
 */
function getPathFromResource($resource): ?string
{
    \Inilim\Tool\Method\Assert\resource($resource);
    // INFO возможно тут получить ошибку если у ресурса нету URI
    return \stream_get_meta_data($resource)['uri'] ?? null;
}
