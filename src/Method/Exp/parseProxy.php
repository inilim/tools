<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author guzzle/guzzle
 * Parses the given proxy URL to make it compatible with the format PHP's stream context expects.
 * 
 * @return array{proxy:string,auth:null|string}
 */
function parseProxy(string $url): array
{
    $parsed = \parse_url($url);

    if ($parsed !== false && isset($parsed['scheme']) && $parsed['scheme'] === 'http') {
        if (isset($parsed['host']) && isset($parsed['port'])) {
            $auth = null;
            if (isset($parsed['user']) && isset($parsed['pass'])) {
                $auth = \base64_encode("{$parsed['user']}:{$parsed['pass']}");
            }

            return [
                'proxy' => "tcp://{$parsed['host']}:{$parsed['port']}",
                'auth'  => $auth ? "Basic {$auth}" : null,
            ];
        }
    }

    // Return proxy as-is.
    return [
        'proxy' => $url,
        'auth'  => null,
    ];
}
