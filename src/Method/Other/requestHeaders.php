<?php

namespace Inilim\Tool\Method\Other;

/**
 * @return array<string,string>
 */
function requestHeaders(?array $_server = null)
{
    $headers = [];

    if (\function_exists('getallheaders')) {
        $headers = \getallheaders();
        if ($headers !== false) {
            return \array_change_key_case($headers, \CASE_UPPER);
        }
    }

    foreach (($_server ?? $_SERVER) as $name => $value) {
        /** @var string $name */
        if (
            ($http = (\strpos($name, 'HTTP_') === 0))
            ||
            $name == 'CONTENT_TYPE' || $name == 'CONTENT_LENGTH'
        ) {
            if ($http) $name = \substr($name, 5);
            $name = \strtr($name, '_', '-');
            $headers[$name] = $value;
        }
    }

    return $headers;
}
