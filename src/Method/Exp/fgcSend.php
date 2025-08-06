<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

use function Inilim\Tool\Method\Assert\boolFalse;
use function Inilim\Tool\Method\Assert\inArray;
use function Inilim\Tool\Method\Assert\resOrstr;

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
 * 
 * @throws \InvalidArgumentException from asserts
 * @throws \RuntimeException from tryFopen
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
        public bool $throw    = false;
        public bool $contentInit = false;

        /**
         * @param string $url
         * @param ParamOptions $options
         * @return Return_fgcSend
         */
        function __invoke(&$url, &$options): array
        {
            try {
                return $this->wrapInvoke($url, $options);
            } catch (\Throwable $e) {
                if ($this->throw) {
                    throw $e;
                }
                de($e->getMessage());
                $err = [];
            }

            return [];
        }

        /**
         * @param string $url
         * @param ParamOptions $options
         * @return Return_fgcSend
         */
        function wrapInvoke(&$url, &$options): array
        {
            $this->url     = &$url;
            $this->options = &$options;
            $this->debug   = $this->options['debug'] ?? $this->debug;
            $this->throw   = $this->options['throw'] ?? $this->throw;
            unset($url, $options);

            if (!$this->debug) {
                unset($this->options['debug'], $this->options['throw']);
            }
            // de($this);

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $this->processFirstHeaders()
                ->optMethod()
                ->optTimeout()
                ->optAllowRedirects()
                ->optAllowRedirectsMax()
                ->optVerify()
                ->optVersion()
                ->optQuery()
                ->optAuth()
                ->optProxy()
                ->optMultipart()
                ->optFormParams()
                ->optJson()
                ->optBody();

            de($this);

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
                    'method'  => $this->method,
                    'headers' => $this->headers,
                ],
            ];
        }

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        function prepareErrors(): array
        {
            if ($this->result['exception'] && $this->throw) {
                throw $this->result['exception'];
            }

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
            $method = $this->options['method'] ?? null;

            if (isset($method)) {
                \Inilim\Tool\Method\Assert\string($method);
                $method = \strtolower($method);
                \Inilim\Tool\Method\Assert\inArray(
                    $method,
                    ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                    'method allowed GET,POST,PUT,PATCH,DELETE,OPTIONS'
                );
            } else {
                $method = $this->method;
            }

            /**
             * INFO регистр важен
             * @see https://www.php.net/manual/ru/context.http.php#101933
             */

            // INFO PHP: php по умолчанию ставит метод GET
            $this->ctxOptsHttp['method'] = $this->method = $method;

            if (!$this->debug) {
                unset($this->options['method']);
            }

            return $this;
        }

        function optQuery()
        {
            $query = $this->options['query'] ?? null;

            if (isset($query)) {
                \Inilim\Tool\Method\Assert\strOrArr($query);

                $query = \is_array($query)
                    ? \http_build_query($query)
                    : $query;

                $parsed = \parse_url($this->url, \PHP_URL_QUERY);
                if ($parsed) {
                    $this->url .= '&' . $query;
                } else {
                    $this->url .= '?' . $query;
                }
            }

            if (!$this->debug) {
                unset($this->options['query']);
            }

            return $this;
        }

        function optVerify()
        {
            $verify = $this->options['verify'] ?? null;

            if (isset($verify)) {
                \Inilim\Tool\Method\Assert\strOrBool($verify);
            } else {
                // Guzzle по дефолту true, у нас false
                $verify = false;
            }

            /**
             * @see \vendor\guzzlehttp\guzzle\src\Handler\StreamHandler.php
             */

            if ($verify === false) {
                /**
                 * в php74 эти параметры не обязательны.
                 * но с версии php8 Эти параметры важны, иногра вылетают ошибки а иногда задержка
                 */
                $this->ctxOptsSll['verify_peer']      = false;
                $this->ctxOptsSll['verify_peer_name'] = false;
            } elseif ($verify === true) {
                // INFO в 8 версии Guzzle функция defaultCaBundle будет удалена
                $this->ctxOptsSll['cafile']                   = \Inilim\Tool\Method\Other\defaultCaBundle();
                $this->ctxOptsSll['ssl']['verify_peer']       = true;
                $this->ctxOptsSll['ssl']['verify_peer_name']  = true;
                $this->ctxOptsSll['ssl']['allow_self_signed'] = false;
            } else {
                \Inilim\Tool\Method\Assert\file($verify, 'SSL CA bundle not found: ' . $verify);

                $this->ctxOptsSll['cafile']            = $verify;
                $this->ctxOptsSll['verify_peer']       = true;
                $this->ctxOptsSll['verify_peer_name']  = true;
                $this->ctxOptsSll['allow_self_signed'] = false;
            }

            if (!$this->debug) {
                unset($this->options['verify']);
            }

            return $this;
        }

        function optAuth()
        {
            $auth = $this->options['auth'] ?? null;

            if (isset($auth)) {
                \Inilim\Tool\Method\Assert\strOrArr($auth);

                if (\is_string($auth)) {
                    $this->addHeaders('authorization', ['Basic ' . $auth]);
                } else {
                    \Inilim\Tool\Method\Assert\allString($auth);

                    $this->addHeaders('authorization', [
                        'Basic ' . \base64_encode($auth[0] . ':' . $auth[1])
                    ]);
                }
            }

            if (!$this->debug) {
                unset($this->options['auth']);
            }

            return $this;
        }

        function optProxy()
        {
            $proxy = $this->options['proxy'] ?? null;

            if (isset($proxy)) {
                \Inilim\Tool\Method\Assert\string($proxy);
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

            $allow = $this->options['allow_redirects'] ?? null;

            if (isset($allow)) {
                \Inilim\Tool\Method\Assert\boolean($allow);
                $allow = (int)$allow;
            } else {
                // default: true
                $allow = 1;
            }

            $this->ctxOptsHttp['follow_location'] = $allow;

            if (!$this->debug) {
                unset($this->options['follow_location']);
            }

            return $this;
        }

        function optAllowRedirectsMax()
        {
            // Guzzle default 5
            // Максимальное количество перенаправлений, которым можно следовать.
            // Значение 1 или меньше означает, что перенаправления не выполняются.

            $allowMax = $this->options['allow_redirects.max'] ?? null;

            if (isset($allowMax)) {
                \Inilim\Tool\Method\Assert\integer($allowMax);
                $allowMax++;
            } else {
                $allowMax = 5 + 1;
            }

            $this->ctxOptsHttp['max_redirects'] = $allowMax;

            if (!$this->debug) {
                unset($this->options['allow_redirects.max']);
            }

            return $this;
        }

        function optTimeout()
        {
            // Guzzle default 0 inf
            $timeout = $this->options['timeout'] ?? null;

            if (isset($timeout)) {
                \Inilim\Tool\Method\Assert\positiveFloatOrInt($timeout);
                $timeout = (float)$timeout;
            } else {
                // default
                $timeout = 10_000.0;
            }

            $this->ctxOptsHttp['timeout'] = $timeout;

            if (!$this->debug) {
                unset($this->options['timeout']);
            }

            return $this;
        }

        function optVersion()
        {
            $version = $this->options['version'] ?? null;

            if (isset($version)) {
                \Inilim\Tool\Method\Assert\positiveFloat($version);
            } else {
                $version = 1.1;
            }

            // INFO PHP: С PHP 8.0.0 значение по умолчанию — 1.1; до этой версии значение по умолчанию равнялось 1.0.
            // Guzzle default 1.1
            $this->ctxOptsHttp['protocol_version'] = $version;

            if (!$this->debug) {
                unset($this->options['version']);
            }

            return $this;
        }

        function optMultipart()
        {
            $multipart = $this->options['multipart'] ?? null;

            // не обьявлен или пустой
            if (!isset($multipart) || !$multipart) {
                if (!$this->debug) {
                    unset($this->options['multipart']);
                }
                return $this;
            }

            \Inilim\Tool\Method\Assert\boolFalse(
                $this->contentInit,
                'Only one of body, form_params, json, or multipart can be set in the request.'
            );
            \Inilim\Tool\Method\Assert\notInArray(
                $this->method,
                ['GET', 'HEAD'],
                'HTTP method GET,HEAD does not support body'
            );

            foreach ($multipart as $element) {

                \Inilim\Tool\Method\Assert\keysExists(
                    $element,
                    ['contents', 'name'],
                    'A "contents" and "name" keys is required from option multipart'
                );

                $content = $element['contents'] ?? null;
                \Inilim\Tool\Method\Assert\resOrstr($content);
                /** @var string|resource $content */

                if (\is_string($content)) {
                    $stream = \Inilim\Tool\Method\Other\tryFopen('php://temp', 'r+');
                    if ($content !== '') {
                        \fwrite($stream, $content);
                        \fseek($stream, 0);
                    }
                    $content = $stream;
                } else {
                    /*
                    * The 'php://input' is a special stream with quirks and inconsistencies.
                    * We avoid using that stream by reading it into php://temp
                    */
                    if ((\stream_get_meta_data($content)['uri'] ?? '') === 'php://input') {
                        $stream = \Inilim\Tool\Method\Other\tryFopen('php://temp', 'w+');
                        \stream_copy_to_stream($content, $stream);
                        \fseek($stream, 0);
                        $content = $stream;
                    }
                }
                unset($stream);

                $metaData = \stream_get_meta_data($content);

                // FILENAME Guzzle procedure

                if (empty($element['filename'])) {
                    $uri = $metaData['uri'] ?? null;
                    if ($uri && \is_string($uri) && \substr($uri, 0, 6) !== 'php://' && \substr($uri, 0, 7) !== 'data://') {
                        $element['filename'] = $uri;
                    }
                    unset($uri);
                } else {
                    \Inilim\Tool\Method\Assert\string(
                        $element['filename'],
                        'element multipart key filename myst be string'
                    );
                }
                // filename string|unset

                $size = \Inilim\Tool\Method\Other\getSizeResource($content);

                // 
            } // endforeach

            $this->addHeaders('content-type', ['multipart/form-data']);

            if (!$this->debug) {
                unset($this->options['multipart']);
            }

            return $this;
        }

        function optFormParams()
        {
            $params = $this->options['form_params'] ?? null;
            if (!isset($params)) {
                if (!$this->debug) {
                    unset($this->options['multipart']);
                }
                return $this;
            }

            \Inilim\Tool\Method\Assert\boolFalse(
                $this->contentInit,
                'Only one of body, form_params, json, or multipart can be set in the request.'
            );
            \Inilim\Tool\Method\Assert\notInArray(
                $this->method,
                ['GET', 'HEAD'],
                'HTTP method GET,HEAD does not support body'
            );
            \Inilim\Tool\Method\Assert\isArray($params);

            $params = \http_build_query($params, '', '&');
            $this->setContent($params);

            $this->addHeaders('content-type', ['application/x-www-form-urlencoded']);

            return $this;
        }

        function optJson()
        {
            $json = $this->options['json'] ?? null;
            if (!isset($json)) {
                if (!$this->debug) {
                    unset($this->options['json']);
                }
                return $this;
            }

            \Inilim\Tool\Method\Assert\boolFalse(
                $this->contentInit,
                'Only one of body, form_params, json, or multipart can be set in the request.'
            );
            \Inilim\Tool\Method\Assert\notInArray(
                $this->method,
                ['GET', 'HEAD'],
                'HTTP method GET,HEAD does not support body'
            );
            \Inilim\Tool\Method\Assert\strOrArr($json);

            if (\is_string($json)) {
                \Inilim\Tool\Method\Assert\json($json);
            } else {
                $json = \json_encode($json, \JSON_THROW_ON_ERROR);
                /** @var string $json */
            }

            $this->setContent($json);
            $this->addHeaders('content-type', ['application/json']);

            if (!$this->debug) {
                unset($this->options['json']);
            }
            return $this;
        }

        function optBody()
        {
            $body = $this->options['body'] ?? null;

            if (isset($body)) {

                \Inilim\Tool\Method\Assert\boolFalse(
                    $this->contentInit,
                    'Only one of body, form_params, json, or multipart can be set in the request.'
                );
                \Inilim\Tool\Method\Assert\notInArray(
                    $this->method,
                    ['GET', 'HEAD'],
                    'HTTP method GET,HEAD does not support body'
                );
                \Inilim\Tool\Method\Assert\string($body);

                if (!$this->hasHeader('content-type')) {
                    $this->addHeaders('content-type', ['']);
                }

                $this->setContent($body);
            }

            if (!$this->debug) {
                unset($this->options['body']);
            }

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

        /**
         * TODO сделай лучше
         * @param array<string,string|string[]> $headers
         * @return array<string,string[]>
         */
        function prepareHeaders(array $headers): array
        {
            $normHeaders = [];
            foreach ($headers as $name => $values) {
                \Inilim\Tool\Method\Assert\headerName($name);
                \Inilim\Tool\Method\Assert\strOrArr($values);
                $values = \is_string($values) ? [$values] : $values;

                foreach ($values as $value) {
                    \Inilim\Tool\Method\Assert\headerValue($value);
                    $header = $this->normalizeHeader($name, $value);

                    if (
                        /**
                         * @see host: https://www.php.net/manual/ru/context.http.php#125832
                         * эти заголовки устанавливаем мы
                         */
                        \Inilim\Tool\Method\Str\startsWith($header, ['host:', 'connection:', 'content-length:'], true)
                    ) {
                        continue;
                    }

                    $normHeaders[$name] ??= [];
                    $normHeaders[$name][] = $value;
                } // endforeach
            } // endforeach

            return $normHeaders;
        }

        function processFirstHeaders()
        {
            $headers = $this->options['headers'] ?? null;
            if (isset($headers)) {
                $this->headers = $this->prepareHeaders($headers);
            }

            if ($this->debug) {
                unset($this->options['headers']);
            }

            return $this;
        }

        function setContent(string $content)
        {
            \Inilim\Tool\Method\Assert\boolFalse($this->contentInit);
            $this->contentInit = true;
            $this->ctxOptsHttp['content'] = $content;
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

        function normalizeHeader(string $name, string $value): string
        {
            return \strtolower($name) . ': ' . \trim($value, " \t");
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
