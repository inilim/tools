<?php

namespace Inilim\Tool\Method\Json;

\Inilim\Tool\Json::__include('tryDecodeAsArray');
\Inilim\Tool\Arr::__include('dataGet2');

/**
 * @param mixed $default
 * @return mixed
 */
function dataGetFromJson(?string $json, string $dotKey, $default = null)
{
    $t = \Inilim\Tool\Method\Json\tryDecodeAsArray($json, []);
    if (!$t) return $default;
    return \Inilim\Tool\Method\Arr\dataGet2(
        $t,
        $dotKey,
        $default,
    );
}
