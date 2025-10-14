<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

/**
 * @param mixed $default
 * @return mixed
 */
function dataGetFromJson(?string $json, string $dotKey, $default = null)
{
    $t = \Inilim\Tool\Method\Json\tryDecodeAsArray($json, []);
    if (!$t) {
        return $default;
    }
    return \Inilim\Tool\Method\Arr\dataGetV2(
        $t,
        $dotKey,
        $default,
    );
}
