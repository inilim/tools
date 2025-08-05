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
 * 
 * @psalm-import-type ParamOptions from \TypeExp
 * @psalm-import-type Return_fgcSend from \TypeExp
 * 
 * @param ParamOptions $options
 * @return Return_fgcSend
 */
function fgcSendJsonPost(string $url, $body, array $options = [])
{
    if (\is_array($body)) {
        $body = \json_encode($body, \JSON_THROW_ON_ERROR);
    } else {
        \Inilim\Tool\Method\Assert\json($body);
    }
    /** @var string $body */
    $options['body']   = &$body;
    $options['method'] = 'POST';
    $options['headers'] ??= [];
    $options['headers'][] = 'content-type: application/json';

    return \Inilim\Tool\Method\Exp\fgcSend($url, $options);
}
