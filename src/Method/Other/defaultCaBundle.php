<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author guzzle/guzzle
 * 
 * Returns the default cacert bundle for the current system.
 *
 * First, the openssl.cafile and curl.cainfo php.ini settings are checked.
 * If those settings are not configured, then the common locations for
 * bundles found on Red Hat, CentOS, Fedora, Ubuntu, Debian, FreeBSD, OS X
 * and Windows are checked. If any of these file locations are found on
 * disk, they will be utilized.
 *
 * Note: the result of this function is cached for subsequent calls.
 *
 * @throws \Exception if no bundle can be found.
 *
 * INFO defaultCaBundle will be removed in guzzlehttp/guzzle:8.0. This method is not needed in PHP 5.6+.
 */
function defaultCaBundle(): string
{
    static $cached = null;
    /** @var string|null $cached */

    if ($cached) {
        return $cached;
    }

    if ($ca = \ini_get('openssl.cafile')) {
        return $cached = $ca;
    }

    if ($ca = \ini_get('curl.cainfo')) {
        return $cached = $ca;
    }

    $cafiles = [
        // Red Hat, CentOS, Fedora (provided by the ca-certificates package)
        '/etc/pki/tls/certs/ca-bundle.crt',
        // Ubuntu, Debian (provided by the ca-certificates package)
        '/etc/ssl/certs/ca-certificates.crt',
        // FreeBSD (provided by the ca_root_nss package)
        '/usr/local/share/certs/ca-root-nss.crt',
        // SLES 12 (provided by the ca-certificates package)
        '/var/lib/ca-certificates/ca-bundle.pem',
        // OS X provided by homebrew (using the default path)
        '/usr/local/etc/openssl/cert.pem',
        // Google app engine
        '/etc/ca-certificates.crt',
        // Windows?
        'C:\\windows\\system32\\curl-ca-bundle.crt',
        'C:\\windows\\curl-ca-bundle.crt',
    ];

    foreach ($cafiles as $filename) {
        if (\is_file($filename)) {
            return $cached = $filename;
        }
    }

    throw new \Exception('No system CA bundle could be found in any of the the common system locations.');
}
