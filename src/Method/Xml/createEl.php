<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @return \DOMElement
 * @throws \DOMException
 */
function createEl(string $qualifiedName, ?string $value = null, string $encoding = 'UTF-8', string $namespace = '')
{
    \Inilim\Tool\Method\Assert\extPhp('dom');

    $doc  = new \DOMDocument('1.0', $encoding);
    $el   = new \DOMElement($qualifiedName, $value, $namespace);
    $root = @$doc->createElement('root');
    if ($root === false) {
        throw new \DOMException('Failed DOMDocument::createElement("root")');
    }
    $doc->appendChild($root);
    $root->appendChild($el);
    return $el;
}
