<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @param \DOMNode $node
 */
function removeNode(object $node): bool
{
    \Inilim\Tool\Method\Assert\extPhp('dom');
    \Inilim\Tool\Method\Assert\isInstanceOf($node, \DOMNode::class);
    if (!$node->ownerDocument) {
        return false;
    }

    if ($node->parentNode) {
        try {
            $node->parentNode->removeChild($node);
            return true;
        } catch (\DOMException $e) {
            return false;
        }
    }

    return false;
}
