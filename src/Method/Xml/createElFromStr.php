<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @skip_build
 * @return \DOMDocumentFragment
 * @throws \DOMException
 */
function createElFromStr(string $string, string $encoding = 'UTF-8')
{
    \Inilim\Tool\Method\Assert\extPhp('dom');

    $doc  = new \DOMDocument('1.0', $encoding);
    $root = @$doc->createElement('root');
    if ($root === false) {
        throw new \DOMException('Failed DOMDocument::createElement("root")');
    }
    $doc->appendChild($root);
    $fragment = @$doc->createDocumentFragment();
    if ($fragment === false) {
        throw new \DOMException('Failed DOMDocument::createDocumentFragment');
    }
    if (!@$fragment->appendXML($string)) {
        throw new \DOMException(\sprintf('Failed DOMDocumentFragment::appendXML("%s")', $string));
    }
    $root->appendChild($fragment);
    return $fragment;
}
