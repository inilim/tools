<?php

namespace Inilim\Tool\Method\Other;

/**
 * from Symfony
 * @return array<string,string>
 */
function requestHeadersV2(?array $_server = null)
{
    $_server ??= $_SERVER;
    $headers = [];
    foreach ($_server as $key => $value) {
        if (\stripos($key, 'HTTP_') === 0) {
            $headers[\substr($key, 5)] = $value;
        } elseif (\in_array($key, ['CONTENT_TYPE', 'CONTENT_LENGTH', 'CONTENT_MD5'], true) && '' !== $value) {
            $headers[$key] = $value;
        }
    }

    if (isset($_server['PHP_AUTH_USER'])) {
        $headers['PHP_AUTH_USER'] = $_server['PHP_AUTH_USER'];
        $headers['PHP_AUTH_PW'] = $_server['PHP_AUTH_PW'] ?? '';
    } else {
        /*
        * php-cgi under Apache does not pass HTTP Basic user/pass to PHP by default
        * For this workaround to work, add these lines to your .htaccess file:
        * RewriteCond %{HTTP:Authorization} .+
        * RewriteRule ^ - [E=HTTP_AUTHORIZATION:%0]
        *
        * A sample .htaccess file:
        * RewriteEngine On
        * RewriteCond %{HTTP:Authorization} .+
        * RewriteRule ^ - [E=HTTP_AUTHORIZATION:%0]
        * RewriteCond %{REQUEST_FILENAME} !-f
        * RewriteRule ^(.*)$ index.php [QSA,L]
        */

        $authorizationHeader = null;
        if (isset($_server['HTTP_AUTHORIZATION'])) {
            $authorizationHeader = $_server['HTTP_AUTHORIZATION'];
        } elseif (isset($_server['REDIRECT_HTTP_AUTHORIZATION'])) {
            $authorizationHeader = $_server['REDIRECT_HTTP_AUTHORIZATION'];
        }

        if (null !== $authorizationHeader) {
            if (0 === \stripos($authorizationHeader, 'basic ')) {
                // Decode AUTHORIZATION header into PHP_AUTH_USER and PHP_AUTH_PW when authorization header is basic
                $exploded = \explode(':', \base64_decode(\substr($authorizationHeader, 6)), 2);
                if (2 == \count($exploded)) {
                    [$headers['PHP_AUTH_USER'], $headers['PHP_AUTH_PW']] = $exploded;
                }
            } elseif (empty($_server['PHP_AUTH_DIGEST']) && (0 === \stripos($authorizationHeader, 'digest '))) {
                // In some circumstances PHP_AUTH_DIGEST needs to be set
                $headers['PHP_AUTH_DIGEST'] = $authorizationHeader;
                $_server['PHP_AUTH_DIGEST'] = $authorizationHeader;
            } elseif (0 === \stripos($authorizationHeader, 'bearer ')) {
                /*
                     * XXX: Since there is no PHP_AUTH_BEARER in PHP predefined variables,
                     *      I'll just set $headers['AUTHORIZATION'] here.
                     *      https://php.net/reserved.variables.server
                     */
                $headers['AUTHORIZATION'] = $authorizationHeader;
            }
        }
    }

    if (isset($headers['AUTHORIZATION'])) {
        return $headers;
    }

    // PHP_AUTH_USER/PHP_AUTH_PW
    if (isset($headers['PHP_AUTH_USER'])) {
        $headers['AUTHORIZATION'] = 'Basic ' . \base64_encode($headers['PHP_AUTH_USER'] . ':' . ($headers['PHP_AUTH_PW'] ?? ''));
    } elseif (isset($headers['PHP_AUTH_DIGEST'])) {
        $headers['AUTHORIZATION'] = $headers['PHP_AUTH_DIGEST'];
    }

    return $headers;
}
