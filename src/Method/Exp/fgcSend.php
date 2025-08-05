<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * 
 * It is not recommended to use it in production.
 * Exclusively for debugging, testing, and development.
 * 
 * TODO multipart
 * 
 * @psalm-import-type Return_fgcSend from \TypeExp
 * @psalm-import-type ParamOptions from \TypeExp
 * @psalm-import-type Return_get from \TypeFile
 * 
 * @param ParamOptions $options
 * @return Return_fgcSend
 */
function fgcSend(string $url, array $options = [])
{
    $internal = new class() {
        public string $url;
        /**
         * @var ParamOptions
         */
        public array $options;
        /**
         * @var array<string,string[]>
         */
        public array $headers = [];
        public array $ctxOpts = [];
        public array $ctxOptsHttp = [];
        public ?array $ctxParams = null;
        /**
         * @var Return_get
         */
        public array $result;
        public array $ctxOptsSll  = [];
        public string $method = 'GET';
        public bool $debug    = false;

        /**
         * @param string $url
         * @param ParamOptions $options
         * @return Return_fgcSend
         */
        function __invoke(&$url, &$options): array
        {
            $this->url     = &$url;
            $this->options = &$options;
            $this->debug   = $this->options['debug'] ?? false;
            unset($url, $options);

            // de($this);

            // ---------------------------------------------
            // 
            // ---------------------------------------------
            // TODO
            // 'ignore_errors'   => false, // default: false

            $this->processFirstHeaders()
                ->optMethod()
                ->optTimeout()
                ->optAllowRedirects()
                ->optAllowRedirectsMax()
                ->optVerify()
                ->optVersion();

            if ($this->options['query'] ?? null) {
                $this->optQuery();
            }
            if ($this->options['auth'] ?? null) {
                $this->optAuth();
            }
            if ($this->options['proxy'] ?? null) {
                $this->optProxy();
            }
            if ($this->options['multipart'] ?? null) {
                $this->optMultipart();
            }
            $this->optBody();

            de($this);

            if (!$this->debug) {
                unset(
                    $this->options['headers'],
                    $this->options['method'],
                    $this->options['timeout'],
                    $this->options['allow_redirects'],
                    $this->options['allow_redirects.max'],
                    $this->options['version'],
                    $this->options['debug'],
                    $this->options['query'],
                    $this->options['auth'],
                    $this->options['proxy'],
                    $this->options['multipart'],
                    $this->options['body'],
                );
            }

            $this->processSecondaryHeaders();

            // ---------------------------------------------
            // Context params
            // ---------------------------------------------

            if (
                $this->debug === true &&
                \defined('STDOUT')
            ) {
                $ident = $this->method . ' ' . $this->url;

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

                /**
                 * @see https://www.php.net/manual/ru/context.params.php
                 * @see https://www.php.net/manual/ru/function.stream-notification-callback.php
                 */
                $this->ctxParams = ['notification' => $fn1];
                unset($fn1, $ident);
            }

            // ---------------------------------------------
            // Create context
            // ---------------------------------------------

            /**
             * @see https://www.php.net/manual/ru/context.http.php
             * method, header, user_agent, content, proxy, request_fulluri, follow_location, max_redirects, protocol_version, timeout, ignore_errors
             */

            $this->ctxOpts['http'] = &$this->ctxOptsHttp;
            $this->ctxOpts['ssl']  = &$this->ctxOptsSll;

            $resourceContext = \stream_context_create($this->ctxOpts, $this->ctxParams);
            if (!$this->debug) {
                $this->ctxParams = null;
                unset($this->ctxOptsHttp, $this->ctxOptsSll, $this->ctxOpts);
            }

            // dde($resourceContext);
            // dde($this->ctx);
            de($this);

            // ---------------------------------------------
            // exec
            // ---------------------------------------------

            $ms = \Inilim\Tool\Method\Time\unixMs();
            $this->result = \Inilim\Tool\Method\File\getViaArray([
                'context'    => $resourceContext,
                'pathToFile' => $this->url,
            ]);
            unset($resourceContext);
            if ($this->result['result'] !== null) {
                $ms = \Inilim\Tool\Method\Time\unixMs() - $ms;
            } else {
                $ms = -1;
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            de($this);

            return [
                'response' => [
                    'body'     => $this->result['result'],
                    'headers'  => $this->result['http_response_header'] ?? [],
                    'code'     => $this->defineCode(),
                    'size'     => $this->defineSize(),
                    'time'     => $ms,
                ],
                'request' => [
                    'url'     => $this->url,
                    'body'    => $this->ctxOptsHttp['content'] ?? null,
                    'method'  => $this->ctxOptsHttp['method'],
                    'headers' => $this->ctxOptsHttp['header'],
                ],
                'debug' => [
                    'ctxOpts'    => $this->ctxOpts,
                    'options'    => $this->options,
                    'err'        => $this->prepareErrors(),
                ],
            ];
        }

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        function prepareErrors(): array
        {
            // ---------------------------------------------
            // TODO нужно ли обрабатывать исключения?
            // ---------------------------------------------
            if (!$this->result['exception']) {
                return [];
            }

            $err = [];
            foreach ($this->result['exception'] as $e) {
                $err[] = $e->getMessage();
            }

            return $err;
        }

        function defineSize(): int
        {
            if ($this->result['result'] === null) {
                return -1;
            }

            return \strlen($this->result['result']);
        }

        function defineCode(): int
        {
            if ($this->result['result'] === null || !($this->result['http_response_header'] ?? [])) {
                return -1;
            }

            $code = \preg_grep('/^HTTP.*\s([0-9]{3})\s/', $this->result['http_response_header']);
            /** @var string[] $code */

            if ($code) {
                $code = \array_pop($code);
                /** @var string $code */
                \preg_match('/\s([0-9]{3})\s/', $code, $m);
                $code = \intval($m[1] ?? -1);
            } else {
                $code = -1;
            }

            return $code;
        }

        function optMethod()
        {
            /**
             * регистр важен
             * @see https://www.php.net/manual/ru/context.http.php#101933
             */
            $this->method = \strtoupper($this->options['method'] ?? $this->method);

            \Inilim\Tool\Method\Assert\inArray(
                $this->method,
                ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                '$method allowed GET,POST,PUT,PATCH,DELETE,OPTIONS'
            );

            // PHP: php по умолчанию ставит метод GET
            $this->ctxOptsHttp['method'] = &$this->method;

            return $this;
        }

        function optQuery()
        {
            $query = $this->options['query'];
            $query = \is_array($query)
                ? \http_build_query($query)
                : $query;
            /** @var string $query */

            $parsed = \parse_url($this->url, \PHP_URL_QUERY);
            if ($parsed) {
                $this->url .= '&' . $query;
            } else {
                $this->url .= '?' . $query;
            }

            return $this;
        }

        function optVerify()
        {
            $verify = $this->options['verify'] ?? false;
            // Guzzle по дефолту true
            if ($verify === false) {
                /**
                 * в php74 эти параметры не обязательны.
                 * но с версии php8 Эти параметры важны, иногра вылетают ошибки а иногда задержка
                 */
                $this->ctxOptsSll['verify_peer']      = false;
                $this->ctxOptsSll['verify_peer_name'] = false;
            } elseif (\is_string($verify)) {
                /**
                 * TODO Проверить установку сертификата
                 * @see \vendor\guzzlehttp\guzzle\src\Handler\StreamHandler.php:add_verify
                 */
                if (!\is_file($verify)) {
                    throw new \RuntimeException('SSL CA bundle not found: ' . $verify);
                }
                $this->ctxOptsSll['cafile']            = $verify;
                $this->ctxOptsSll['verify_peer']       = true;
                $this->ctxOptsSll['verify_peer_name']  = true;
                $this->ctxOptsSll['allow_self_signed'] = false;
            } else {
                // что тут? TODO
                $verify;
            }

            if (!$this->debug) {
                unset($this->options['verify']);
            }

            return $this;
        }

        function optAuth()
        {
            $auth = $this->options['auth'];
            if (\is_array($auth) && \sizeof($auth) === 2) {
                $this->addHeaders('authorization', [
                    'Basic ' . \base64_encode($auth[0] . ':' . $auth[1])
                ]);
            } elseif (\is_string($auth)) {
                $this->addHeaders('authorization', ['Basic ' . $auth]);
            } else {
                throw new \InvalidArgumentException('option "auth" must be string[] or string');
            }

            if (!$this->debug) {
                unset($this->options['auth']);
            }

            return $this;
        }

        function optProxy()
        {
            \Inilim\Tool\Method\Assert\string($this->options['proxy']);

            /**
             * Если устанавливаются прокси то нужно поставить флаг в true request_fulluri
             * лично не проверял
             * @see https://www.php.net/manual/ru/context.http.php#110449
             */
            $this->ctxOptsHttp['request_fulluri'] = true;
            $parsed = \Inilim\Tool\Method\Exp\parseProxy($this->options['proxy']);
            $this->ctxOptsHttp['proxy'] = $parsed['proxy'];

            if ($parsed['auth']) {
                $this->addHeaders('proxy-authorization', [$parsed['auth']]);
            }

            if (!$this->debug) {
                unset($this->options['proxy']);
            }

            return $this;
        }

        function optAllowRedirects()
        {
            // Guzzle default true а точнее там массив [
            //     'max'             => 5,
            //     'strict'          => false,
            //     'referer'         => false,
            //     'protocols'       => ['http', 'https'],
            //     'track_redirects' => false
            // ]

            $this->ctxOptsHttp['follow_location'] = isset($this->options['allow_redirects'])
                ? (int)$this->options['allow_redirects']
                : 1; // default: 1

            return $this;
        }

        function optAllowRedirectsMax()
        {
            // Guzzle default 5
            // Максимальное количество перенаправлений, которым можно следовать.
            // Значение 1 или меньше означает, что перенаправления не выполняются.

            $this->ctxOptsHttp['max_redirects'] = isset($this->options['allow_redirects.max'])
                ? ($this->options['allow_redirects.max'] + 1)
                : (5 + 1);

            return $this;
        }

        function optTimeout()
        {
            // Guzzle default 0 inf
            $timeout = $this->options['timeout'] ?? null;
            if (isset($timeout)) {
                \Inilim\Tool\Method\Assert\positiveFloatOrInt($timeout);
            }

            $this->ctxOptsHttp['timeout'] = isset($this->options['timeout'])
                ? \abs((float)$this->options['timeout'])
                : 10_000.0; // типа бесконечность

            return $this;
        }

        function optVersion()
        {
            // PHP: С PHP 8.0.0 значение по умолчанию — 1.1; до этой версии значение по умолчанию равнялось 1.0.
            // Guzzle default 1.1

            $this->ctxOptsHttp['protocol_version'] = $this->options['version'] ?? 1.1;
            return $this;
        }

        function optBody()
        {
            if ($this->method === 'GET' && isset($this->options['body'])) {
                throw new \InvalidArgumentException('Set body method GET');
            }

            $body = $this->options['body'] ?? null;
            if ($body === '') {
                $body = null;
            }

            if ($body !== null && $this->method !== 'GET') {
                $this->ctxOptsHttp['content'] = &$this->options['body'];
            }

            return $this;
        }

        function optMultipart()
        {
            foreach ($this->options['multipart'] as $element) {
                foreach (['contents', 'name'] as $key) {
                    if (!\array_key_exists($key, $element)) {
                        throw new \InvalidArgumentException("A '{$key}' key is required from option multipart");
                    }
                }

                // CONTENT

                if (\is_string($element['contents'])) {
                    // $stream = self::tryFopen('php://temp', 'r+');
                    $stream = '';
                    if ($element['contents'] !== '') {
                        \fwrite($stream, $element['contents']);
                        \fseek($stream, 0);
                    }
                } elseif (\is_resource($element['contents'])) {
                    $stream = $element['contents'];
                } else {
                    throw new \InvalidArgumentException();
                }

                $element['meta_data'] = \stream_get_meta_data($stream);

                // FILENAME Guzzle procedure

                if (empty($element['filename'])) {
                    $uri = $element['meta_data']['uri'] ?? null;
                    if ($uri && \is_string($uri) && \substr($uri, 0, 6) !== 'php://' && \substr($uri, 0, 7) !== 'data://') {
                        $element['filename'] = $uri;
                    }
                    unset($uri);
                }

                $size = \Inilim\Tool\Method\Other\getSizeResource($stream);

                // 
            } // endforeach

            return $this;
        }

        function hasHeader(string $name): bool
        {
            $name = \strtolower($name);
            return isset($this->headers[$name]) && $this->headers[$name];
        }

        /**
         * @return string[]
         */
        function getHeader(string $name): array
        {
            $name = \strtolower($name);
            if (!isset($this->headers[$name])) {
                return [];
            }
            return $this->headers[$name];
        }

        function processFirstHeaders()
        {
            $headers = $this->options['headers'] ?? [];

            foreach ($headers as $nameOrIdx => &$header) {

                if (\is_array($header)) {
                    foreach ($header as $item) {
                        $headers[] = \is_string($nameOrIdx) ? $this->normalizeHeader($nameOrIdx, $item) : $item;
                    }
                    unset($headers[$nameOrIdx]);
                    continue;
                }

                if (\is_string($nameOrIdx)) {
                    $t = \sprintf('%s: %s', $nameOrIdx, $header);
                } else {
                    $t = $header;
                }
                $header = null;

                [$name, $header] = \explode(':', $t, 2);
                if (!\is_string($name) || !\is_string($header)) {
                    throw new \InvalidArgumentException(\sprintf(
                        'Header invalid "%s"',
                        $t
                    ));
                }

                if (
                    /**
                     * @see host: https://www.php.net/manual/ru/context.http.php#125832
                     * эти заголовки устанавливаем мы
                     */
                    \Inilim\Tool\Method\Str\startsWith($t, ['host:', 'connection:', 'content-length:'], true)
                ) {
                    unset($headers[$nameOrIdx]);
                    continue;
                }

                if ($this->hasHeader($name)) {
                    throw new \InvalidArgumentException(\sprintf(
                        'Repeating header "%s"',
                        $name
                    ));
                }

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                $this->addHeaders($name, [$header]);
                unset($headers[$nameOrIdx]);
            } // endforeach

            if ($this->debug) {
                unset($this->options['headers']);
            }

            return $this;
        }

        /**
         * @param string[] $headers
         * @return self
         */
        function addHeaders(string $name, array $headers)
        {
            $name = \strtolower($name);
            $this->headers[$name] ??= [];
            foreach ($headers as $header) {
                $this->headers[$name][] = $this->normalizeHeader($name, $header);
            }
            return $this;
        }

        function normalizeHeader(string $name, string $header): string
        {
            return \strtolower($name) . ': ' . \trim($header, " \t");
        }

        function processSecondaryHeaders()
        {
            // Запретите обработчику HTTP добавлять заголовок Content-Type.
            if (!$this->hasHeader('content-type')) {
                $this->addHeaders('content-type', ['']);
            }

            // TODO узнать об Content-Length, не уверен нужен ли
            // if (isset($this->ctxOptsHttp['content'])) {
            // $this->addHeaders('content-length', [(string)\strlen($this->ctxOptsHttp['content'])]);
            // }

            // defaults headers as Postman
            if (!$this->hasHeader('user-agent')) {
                $this->addHeaders('user-agent', ['inilim/fgcSend']);
            }
            if (!$this->hasHeader('accept')) {
                $this->addHeaders('accept', ['*/*']);
            }
            // if (!$this->hasHeader('accept-encoding')) {
            // $this->addHeaders('accept-encoding', ['gzip', 'deflate']);
            // }

            /**
             * для протокола 1.1 connection: keep-alive вреден
             * лично не проверял
             * мои наблюдения в php74 запрос на https://webhook.site/ выполняется за 250мс в php82 500мс
             * @see https://www.php.net/manual/ru/context.http.php#114867
             */
            if (
                (isset($this->ctxOptsHttp['protocol_version']) && $this->ctxOptsHttp['protocol_version'] === 1.1)
                ||
                /**
                 * С PHP 8.0.0 значение по умолчанию — 1.1;
                 * до этой версии значение по умолчанию равнялось 1.0.
                 */
                \PHP_VERSION_ID >= 80000
            ) {
                $this->addHeaders('connection', ['close']);
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $this->ctxOptsHttp['header'] = $this->packHeaders();
            if (!$this->debug) {
                $this->headers = [];
            }

            return $this;
        }

        function packHeaders(): string
        {
            $t = [];

            foreach ($this->headers as &$headers) {
                $t[] = \implode(', ', $headers);
            }

            return \implode("\r\n", $t);
        }
    };

    return $internal->__invoke($url, $options);
}
