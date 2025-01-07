<?php

namespace Inilim\Tool\Method\String;

/**
 * Translate a PHP_URL_# constant to the named array keys PHP uses. | analog wp func "_wp_translate_php_url_constant_to_key"
 * @since 4.7.0
 *
 * @link https://www.php.net/manual/en/url.constants.php
 *
 * @param \PHP_URL_* $constant \PHP_URL_* constant.
 * @return string|empty-string The named key or false.
 */
function translatePhpUrlConstantToKey(int $constant)
{
	if ($constant === \PHP_URL_SCHEME) {
		$r = 'protocol';
	} elseif ($constant === \PHP_URL_HOST) {
		$r = 'domain';
	} elseif ($constant === \PHP_URL_PORT) {
		$r = 'port';
	} elseif ($constant === \PHP_URL_USER) {
		$r = 'login';
	} elseif ($constant === \PHP_URL_PASS) {
		$r = 'password';
	} elseif ($constant === \PHP_URL_PATH) {
		$r = 'path';
	} elseif ($constant === \PHP_URL_QUERY) {
		$r = 'query';
	} elseif ($constant === \PHP_URL_FRAGMENT) {
		$r = 'anchor';
	} else {
		$r = '';
	}

	return $r;
}
