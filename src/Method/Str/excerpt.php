<?php

namespace Inilim\Tool\Method\Str;

/**
 * Extracts an excerpt from text that matches the first instance of a phrase.
 * 
 * @param array{radius?:int,omission?:string} $options
 * @return string|null
 */
function excerpt(string $text, string $phrase = '', array $options = [])
{
    $radius   = $options['radius'] ?? 100;
    $omission = $options['omission'] ?? '...';

    \preg_match('/^(.*?)(' . \preg_quote($phrase, '/') . ')(.*)$/iu', $text, $matches);

    if (empty($matches)) {
        return null;
    }

    // Process start portion
    $start = \Inilim\Tool\Method\Str\ltrim($matches[1]);
    $startWithRadius = \Inilim\Tool\Method\Str\ltrim(
        \mb_substr($start, \max(\mb_strlen($start, 'UTF-8') - $radius, 0), $radius, 'UTF-8')
    );
    if ($startWithRadius !== $start) {
        $startWithRadius = $omission . $startWithRadius;
    }

    // Process end portion
    $end = \Inilim\Tool\Method\Str\rtrim($matches[3]);
    $endWithRadius = \Inilim\Tool\Method\Str\rtrim(
        \mb_substr($end, 0, $radius, 'UTF-8')
    );
    if ($endWithRadius !== $end) {
        $endWithRadius .= $omission;
    }

    return $startWithRadius . $matches[2] . $endWithRadius;
}
