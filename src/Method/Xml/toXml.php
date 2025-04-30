<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @return ?string
 */
function toXml(\DOMNode $node, int $options = 0)
{
    if ($node instanceof \DOMDocument) {
        return $node->saveXML(null, $options);
    } elseif ($node->ownerDocument === null) {
        return null;
    }
    return $node->ownerDocument->saveXML($node, $options);
}
