<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @return ?string
 */
function toHtml(\DOMNode $node)
{
    if ($node instanceof \DOMDocument) {
        return $node->saveHTML();
    } elseif ($node->ownerDocument === null) {
        return null;
    }
    return $node->ownerDocument->saveHTML($node);
}
