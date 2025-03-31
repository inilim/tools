<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Internet
 * @return string
 */
function requestMethod()
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
