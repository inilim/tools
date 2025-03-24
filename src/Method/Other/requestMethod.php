<?php

namespace Inilim\Tool\Method\Other;

/**
 * @return string
 */
function requestMehod()
{
    $method = $_SERVER['REQUEST_METHOD'] ?? '';

    if ($method == 'POST') {
        $headers = \Inilim\Tool\Method\Other\requestHeaders();
        if (isset($headers['X-HTTP-METHOD-OVERRIDE']) && \in_array($headers['X-HTTP-METHOD-OVERRIDE'], ['PUT', 'DELETE', 'PATCH'])) {
            $method = $headers['X-HTTP-METHOD-OVERRIDE'];
        }
    }

    return $method;
}
