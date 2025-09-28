<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @psalm-import-type Param_1_xpathQueryFromDoc from \TypeXml
 * @link https://php.net/manual/en/domxpath.query.php
 * @author inilim
 * @todo tests
 * @param \DOMDocument $doc
 * @param ?\DOMNode $contextNode
 * @return null|Param_1_xpathQueryFromDoc
 */
function xpathQueryFromDoc(object $doc, string $expression, ?object $contextNode = null, bool $registerNodeNS = true): ?array
{
    \Inilim\Tool\Method\Assert\extPhp('dom');
    \Inilim\Tool\Method\Assert\isInstanceOf($doc, \DOMDocument::class);
    if ($contextNode) {
        \Inilim\Tool\Method\Assert\isInstanceOf($contextNode, \DOMNode::class);
    }
    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($doc, $expression, $contextNode, $registerNodeNS) {
            $xpath = new \DOMXpath($doc);
            $list = $xpath->query($expression, $contextNode, $registerNodeNS);
            if (\is_bool($list)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('DOMXpath::query("%s") failed', $expression),
                    '',
                    -1
                );
                return null;
            }

            return [
                'doc'   => $doc,
                'xpath' => $xpath,
                'list'  => $list,
            ];
        },
        null
    );
}
