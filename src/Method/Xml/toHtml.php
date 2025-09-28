<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @param \DOMNode $node
 */
function toHtml(object $node): ?string
{
    \Inilim\Tool\Method\Assert\extPhp('dom');
    \Inilim\Tool\Method\Assert\isInstanceOf($node, \DOMNode::class);
    if ($node instanceof \DOMDocument) {
        $v = $node->saveHTML();
        if ($v === false) {
            return null;
        }
        return $v;
    } elseif ($node->ownerDocument === null) {
        return null;
    }
    $v = $node->ownerDocument->saveHTML($node);
    if ($v === false) {
        return null;
    }
    return $v;
}
