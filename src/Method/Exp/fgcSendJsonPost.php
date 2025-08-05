<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * 
 * It is not recommended to use it in production.
 * Exclusively for debugging, testing, and development.
 * 
 * @param mixed[]|string $body
 * @param array<string,string>|string[] $headers
 * 
 * @psalm-import-type Return_fgcSend from \TypeExp
 * @return Return_fgcSend
 */
function fgcSendJsonPost(string $url, $body, array $headers = [], array $ctxOptions = [])
{
    if (\is_array($body)) {
        $body = \json_encode($body);
    } else {
        \Inilim\Tool\Method\Assert\json($body);
    }

    $headers[] = 'content-type: application/json';

    return \Inilim\Tool\Method\Exp\fgcSend($url, 'POST', $body, $headers, $ctxOptions);
}
