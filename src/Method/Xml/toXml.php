<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @param \DOMNode $node
 * @return ?string
 */
function toXml(object $node, int $options = 0)
{
    \Inilim\Tool\Method\Assert\extPhp('dom');
    \Inilim\Tool\Method\Assert\isInstanceOf($node, \DOMNode::class);

    if ($node instanceof \DOMDocument) {
        $v = $node->saveXML(null, $options);
        if ($v === false) {
            return null;
        }
        return $v;
    } elseif ($node->ownerDocument === null) {
        return null;
    }
    $v = $node->ownerDocument->saveXML($node, $options);
    if ($v === false) {
        return null;
    }
    return $v;
}
