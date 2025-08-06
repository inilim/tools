<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc7230#section-3.2
 * @author guzzle/guzzle
 * field-value    = *( field-content / obs-fold )
 * field-content  = field-vchar [ 1*( SP / HTAB ) field-vchar ]
 * field-vchar    = VCHAR / obs-text
 * VCHAR          = %x21-7E
 * obs-text       = %x80-FF
 * obs-fold       = CRLF 1*( SP / HTAB )
 * 
 * @psalm-assert string $value
 * @phpstan-assert string $value
 * 
 * @param mixed $value
 */
function headerValue($value, string $message = '')
{
    if (!\is_string($value)) {
        throw new \InvalidArgumentException(\sprintf(
            $message ?: 'Header value must be a string but %s provided.',
            \Inilim\Tool\Method\Other\getType($value)
        ));
    }
    // The regular expression intentionally does not support the obs-fold production, because as
    // per RFC 7230#3.2.4:
    //
    // A sender MUST NOT generate a message that includes
    // line folding (i.e., that has any field-value that contains a match to
    // the obs-fold rule) unless the message is intended for packaging
    // within the message/http media type.
    //
    // Clients must not send a request with line folding and a server sending folded headers is
    // likely very rare. Line folding is a fairly obscure feature of HTTP/1.1 and thus not accepting
    // folding is not likely to break any legitimate use case.
    if (!\preg_match('/^[\x20\x09\x21-\x7E\x80-\xFF]*$/D', $value)) {
        throw new \InvalidArgumentException(
            \sprintf('"%s" is not valid header value.', $value)
        );
    }
}
