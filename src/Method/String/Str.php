<?php

namespace Inilim\String;

use Inilim\FuncCore\FuncCore;
use Closure;
use voku\helper\ASCII;

class Str
{
    /**
     * The cache of snake-cased words.
     *
     * @var array
     */
    // protected $snake_cache = [];

    /**
     * The cache of camel-cased words.
     *
     * @var array
     */
    // protected $camel_cache = [];

    /**
     * The cache of studly-cased words.
     *
     * @var array
     */
    // protected $studly_cache = [];

    /**
     * The callback that should be used to generate random strings.
     *
     * @var callable|null
     */
    protected $random_string_factory;

    function empty(string $str): bool
    {
        return $str === '';
    }

    function nonEmpty(string $str): bool
    {
        return $str !== '';
    }

    function checkLenMax(string $str, int $max): bool
    {
        return $this->length($str) <= $max;
    }

    function checkLenMin(string $str, int $min): bool
    {
        return $this->length($str) >= $min;
    }

    function checkLenBetween(string $str, int $from_to, int $to_from): bool
    {
        if ($from_to > $to_from) {
            list($to_from, $from_to) = [$from_to, $to_from];
        }
        $len = $this->length($str);
        return $len >= $from_to && $len <= $to_from;
    }

    function checkLenEqual(string $str, int $equal): bool
    {
        return $this->length($str) === $equal;
    }

    function startsWithUrlBeforePath(string $url): bool
    {
        if (!\str_contains($url, '://')) return false;
        $t = \preg_split('#[\/\?]#', $this->removeWww($url), 4);
        if (\sizeof($t) < 3) return false;
        $t = \implode('/', \array_slice($t, 0, 3));
        return $this->isUrl($t);
    }

    function isHttpUrl(string $value): bool
    {
        return $this->isUrl($value, ['http', 'https']);
    }

    /**
     * with filter_var "FILTER_VALIDATE_URL"
     */
    function isUrl2(string $url): bool
    {
        return \filter_var($url, \FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Determine if a given value is a valid URL. / realization laravel/symfony
     */
    function isUrl(string $value, array $protocols = []): bool
    {
        if (!\str_contains($value, '://')) return false;


        $protocol_list = empty($protocols)
            ? \str_replace('__SEPARATOR__', '|', \preg_quote(FuncCore::URLProtocolsAsString('__SEPARATOR__')))
            : \implode('|', \array_map(\preg_quote(...), $protocols));

        /*
         * This pattern is derived from Symfony\Component\Validator\Constraints\UrlValidator (7.1).
         *
         * (c) Fabien Potencier <fabien@symfony.com> http://symfony.com
         */
        $pattern = '~^
            (LARAVEL_PROTOCOLS)://                                 # protocol
            (((?:[\_\.\pL\pN-]|%%[0-9A-Fa-f]{2})+:)?((?:[\_\.\pL\pN-]|%%[0-9A-Fa-f]{2})+)@)?  # basic auth
            (
                (?:
                    (?:xn--[a-z0-9-]++\.)*+xn--[a-z0-9-]++            # a domain name using punycode
                        |
                    (?:[\pL\pN\pS\pM\-\_]++\.)+[\pL\pN\pM]++          # a multi-level domain name
                )\.?
                    |                                                 # or
                \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}                    # an IP address
                    |                                                 # or
                \[
                    (?:(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){6})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:::(?:(?:(?:[0-9a-f]{1,4})):){5})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){4})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,1}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){3})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,2}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){2})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,3}(?:(?:[0-9a-f]{1,4})))?::(?:(?:[0-9a-f]{1,4})):)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,4}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,5}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,6}(?:(?:[0-9a-f]{1,4})))?::))))
                \]  # an IPv6 address
            )
            (:[0-9]+)?                              # a port (optional)
            (?:/ (?:[\pL\pN\pS\pM\-._\~!$&\'()*+,;=:@]|%%[0-9A-Fa-f]{2})* )*    # a path
            (?:\? (?:[\pL\pN\-._\~!$&\'\[\]()*+,;=:@/?]|%%[0-9A-Fa-f]{2})* )?   # a query (optional)
            (?:\# (?:[\pL\pN\-._\~!$&\'()*+,;=:@/?]|%%[0-9A-Fa-f]{2})* )?       # a fragment (optional)
        $~ixuD';

        return \preg_match(\str_replace('LARAVEL_PROTOCOLS', $protocol_list, $pattern), $value) > 0;
    }

    /**
     * Indicate that random strings should be created normally and not using a custom factory.
     */
    function createRandomStringsNormally(): void
    {
        $this->random_string_factory = null;
    }
}
