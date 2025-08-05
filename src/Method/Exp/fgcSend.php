<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * 
 * It is not recommended to use it in production.
 * Exclusively for debugging, testing, and development.
 * 
 * @param array<string,string>|string[] $headers
 * return array{response:array{body:null|string,headers:string[],code:int,size:int,time:int},request:array{url:string,body:null|string,method:string,headers:string}}
 * 
 * @psalm-import-type Return_fgcSend from \TypeExp
 * @return Return_fgcSend
 */
function fgcSend(string $url, string $method = 'GET', ?string $body = null, array $headers = [], array $ctxOptions = [])
{
    /**
     * регистр важен
     * @see https://www.php.net/manual/ru/context.http.php#101933
     */
    $method = \strtoupper($method);

    \Inilim\Tool\Method\Assert\inArray(
        $method,
        ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
        '$method allowed GET,POST,PUT,PATCH,DELETE,OPTIONS'
    );

    $http = [
        'method'          => $method, // default: GET
        'timeout'         => 5.0, // seconds default: 60
        'follow_location' => 1, // default: 1
        'max_redirects'   => 5, // default: 20
        // 'request_fulluri' => true, // default: false
        // 'ignore_errors'   => false, // default: false
        // 'protocol_version' => 1.1, // С PHP 8.0.0 значение по умолчанию — 1.1; до этой версии значение по умолчанию равнялось 1.0.
    ];

    // ---------------------------------------------
    // Content/Body
    // ---------------------------------------------

    if ($body === '') {
        $body = null;
    }

    if ($body !== null && $method !== 'GET') {
        $http['content'] = $body;
    }
    unset($method, $body);

    // ---------------------------------------------
    // headers
    // ---------------------------------------------

    $hasUserUgent      = false;
    $hasAccept         = false;
    $hasAcceptEncoding = false;
    $hasContentType    = false;
    foreach ($headers as $name => &$header) {
        if (\is_string($name)) {
            $header = \sprintf('%s: %s', $name, $header);
        }

        /**
         * @see https://www.php.net/manual/ru/context.http.php#125832
         */
        if (\Inilim\Tool\Method\Str\startsWith($header, 'host:', true)) {
            unset($headers[$name]);
            continue;
        }

        /**
         * не требуется
         */
        if (\Inilim\Tool\Method\Str\startsWith($header, 'connection:', true)) {
            unset($headers[$name]);
            continue;
        }
        /**
         * не требуется
         */
        if (\Inilim\Tool\Method\Str\startsWith($header, 'content-length:', true)) {
            unset($headers[$name]);
            continue;
        }

        if (!$hasAccept && \Inilim\Tool\Method\Str\startsWith($header, 'accept:', true)) {
            $hasAccept = true;
        }
        if (!$hasContentType && \Inilim\Tool\Method\Str\startsWith($header, 'content-type:', true)) {
            $hasContentType = true;
        }
        if (!$hasUserUgent && \Inilim\Tool\Method\Str\startsWith($header, 'user-agent:', true)) {
            $hasUserUgent = true;
        }
        if (!$hasAcceptEncoding && \Inilim\Tool\Method\Str\startsWith($header, 'accept-encoding:', true)) {
            $hasAcceptEncoding = true;
        }
    } // endforeach

    // ---------------------------------------------
    // Proxy
    // TODO
    // ---------------------------------------------

    /**
     * Если устанавливаются прокси то нужно поставить флаг в true
     * лично не проверял
     * @see https://www.php.net/manual/ru/context.http.php#110449
     */
    // if (isset($ctxOptions['proxy'])) {
    //     $http['request_fulluri'] = true;
    // }

    // if (isset($ctxOptions['proxy']) && \is_string($ctxOptions['proxy'])) {
    //     $uri = $ctxOptions['proxy'];
    //     $parsed = \Inilim\Tool\Method\Exp\parseProxy($uri);
    //     $options['http']['proxy'] = $parsed['proxy'];

    //     if ($parsed['auth']) {
    //         $headers[] = "Proxy-Authorization: {$parsed['auth']}";
    //     }
    //     unset($parsed);
    // }
    // unset($ctxOptions['proxy']);

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    // Запретите обработчику HTTP добавлять заголовок Content-Type.
    if (!$hasContentType) {
        $headers[] = 'content-type:';
    }

    // TODO узнать об Content-Length, не уверен нужен ли
    if (isset($http['content'])) {
        // $headers[] = 'content-length: ' . \strlen($http['content']);
    }

    // defaults headers as Postman
    if (!$hasUserUgent) {
        $headers[] = 'user-agent: ' . __FUNCTION__;
    }
    if (!$hasAccept) {
        $headers[] = 'accept: */*';
    }
    if (!$hasAcceptEncoding) {
        // $headers[] = 'accept-encoding: gzip, deflate';
    }

    /**
     * для протокола 1.1 connection: keep-alive вреден
     * лично не проверял
     * мои наблюдения в php74 запрос на https://webhook.site/ выполняется за 250мс в php82 500мс
     * @see https://www.php.net/manual/ru/context.http.php#114867
     */
    if (
        (isset($http['protocol_version']) && $http['protocol_version'] === 1.1)
        ||
        /**
         * С PHP 8.0.0 значение по умолчанию — 1.1;
         * до этой версии значение по умолчанию равнялось 1.0.
         */
        \Inilim\Tool\Method\Check\php80()
    ) {
        $headers[] = 'connection: close';
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $http['header'] = \implode("\r\n", $headers);
    unset($headers);

    // ---------------------------------------------
    // SSL
    // ---------------------------------------------

    /**
     * в php74 эти параметры не обязательны.
     * но с версии php8 Эти параметры важны, иногра вылетают ошибки а иногда задержка
     */
    $ctxOptions['ssl']['verify_peer']      = false;
    $ctxOptions['ssl']['verify_peer_name'] = false;

    /**
     * TODO если потребуется устанавливать SSL сертификат
     * @see \vendor\guzzlehttp\guzzle\src\Handler\StreamHandler.php:add_verify
     */
    // if (\is_string($verify)) {
    //     $options['ssl']['cafile'] = $verify;
    //     if (!\file_exists($verify)) {
    //         throw new \RuntimeException("SSL CA bundle not found: $verify");
    //     }
    // } elseif ($verify !== true) {
    //     throw new \InvalidArgumentException('Invalid verify request option');
    // }
    // $options['ssl']['verify_peer'] = true;
    // $options['ssl']['verify_peer_name'] = true;
    // $options['ssl']['allow_self_signed'] = false;

    // ---------------------------------------------
    // Context params
    // ---------------------------------------------

    $ctxParams = null;
    if (
        isset($ctxOptions['debug']) &&
        $ctxOptions['debug'] === true &&
        \defined('STDOUT')
    ) {
        $ident = $http['method'] . ' ' . $url;

        $fn1 = static function (int $code, ...$passed) use ($ident): void {

            $map = [
                \STREAM_NOTIFY_CONNECT       => 'CONNECT',
                \STREAM_NOTIFY_AUTH_REQUIRED => 'AUTH_REQUIRED',
                \STREAM_NOTIFY_AUTH_RESULT   => 'AUTH_RESULT',
                \STREAM_NOTIFY_MIME_TYPE_IS  => 'MIME_TYPE_IS',
                \STREAM_NOTIFY_FILE_SIZE_IS  => 'FILE_SIZE_IS',
                \STREAM_NOTIFY_REDIRECTED    => 'REDIRECTED',
                \STREAM_NOTIFY_PROGRESS      => 'PROGRESS',
                \STREAM_NOTIFY_FAILURE       => 'FAILURE',
                \STREAM_NOTIFY_COMPLETED     => 'COMPLETED',
                \STREAM_NOTIFY_RESOLVE       => 'RESOLVE',
            ];
            $args = ['severity', 'message', 'message_code', 'bytes_transferred', 'bytes_max'];

            \fprintf(\STDOUT, '<%s> [%s] ', $ident, $map[$code]);
            foreach (\array_filter($passed) as $i => $v) {
                \fwrite(\STDOUT, $args[$i] . ': "' . $v . '" ');
            }
            \fwrite(\STDOUT, "\n");
        };

        // guzzle
        // $code, $a, $b, $c, $transferred, $total

        // $notification_code,
        // $severity,
        // $message,
        // $message_code,
        // $bytes_transferred,
        // $bytes_max,

        /**
         * @see https://www.php.net/manual/ru/context.params.php
         * @see https://www.php.net/manual/ru/function.stream-notification-callback.php
         */
        $ctxParams = ['notification' => $fn1];
        unset($fn1, $ident);
    }

    // ---------------------------------------------
    // Create context
    // ---------------------------------------------

    /**
     * @see https://www.php.net/manual/ru/context.http.php
     * method, header, user_agent, content, proxy, request_fulluri, follow_location, max_redirects, protocol_version, timeout, ignore_errors
     * @var array{method:string,header:string|string[],user_agent:string,content:string,proxy:string,request_fulluri:bool,follow_location:int,max_redirects:int,protocol_version:float,timeout:float,ignore_errors:bool} $http
     */


    // TODO нужно проверить обьединение
    if (isset($ctxOptions['http']) && \is_array($ctxOptions['http'])) {
        $http = \array_merge($http, $ctxOptions['http']);
    }

    $ctxOptions['http'] = $http;
    unset($http);

    $resourceContext = \stream_context_create($ctxOptions, $ctxParams);
    unset($ctxParams);

    // ---------------------------------------------
    // exec
    // ---------------------------------------------

    $ms = \Inilim\Tool\Method\Time\unixMs();
    $result = \Inilim\Tool\Method\File\getViaArray([
        'context'    => $resourceContext,
        'pathToFile' => $url,
    ]);
    unset($resourceContext);
    $flagResultNull = $result['result'] === null;
    if ($flagResultNull) {
        $ms = -1;
    } else {
        $ms = \Inilim\Tool\Method\Time\unixMs() - $ms;
    }

    // ---------------------------------------------
    // Code
    // TODO нужно обработать редиректы
    // ---------------------------------------------

    $code = -1;
    if (!$flagResultNull) {
        $code = $result['http_response_header'][0] ?? -1;
        if ($code !== -1) {
            \preg_match('/\s([0-9]{3})\s/', $code, $m);
            $code = \intval($m[1] ?? -1);
            unset($m);
        }
    }

    // ---------------------------------------------
    // Size
    // ---------------------------------------------

    $size = -1;
    if (!$flagResultNull) {
        $size = \strlen($result['result']);
    }

    // ---------------------------------------------
    // TODO нужно ли обрабатывать исключения?
    // ---------------------------------------------

    if ($result['exception']) {
        // $err = [];
        // foreach ($result['exception'] as $e) {
        //     /** @var \Exception $e */
        //     $err[] = $e->getMessage();
        // }

        // d($err);
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    return [
        'response' => [
            'body'     => $result['result'],
            'headers'  => $result['http_response_header'] ?? [],
            'code'     => $code,
            'size'     => $size,
            'time'     => $ms,
        ],
        'request' => [
            'url'     => $url,
            'body'    => $ctxOptions['http']['content'] ?? null,
            'method'  => $ctxOptions['http']['method'],
            'headers' => $ctxOptions['http']['header'],
        ],
    ];
}
