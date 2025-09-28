<?php

namespace Inilim\Tool;

class Xml
{
        /**
 * @param \DOMNode $what
 * @param \DOMNode $where
 * @return ?\DOMNode
 * @throws \DOMException
 */
    static function appendChild(object $what, object $where, bool $throw = false): ?object {}

        /**
 * @return \DOMElement
 * @throws \DOMException
 */
    static function createEl(string $qualifiedName, ?string $value = null, string $encoding = 'UTF-8', string $namespace = '') {}

        /**
 * @template Attrs of array<string,string>
 * @template ItemNodeNS of array{nodeName:string,nodeValue:?string,nodeType:int,prefix:string,localName:?string,namespaceURI:?string,isConnected:bool,ownerDocument:?class-string,parentNode:?class-string,parentElement:?class-string}
 * @template ItemNode of array{attributes:Attrs,nodeName:string,nodeValue:?string,nodeType:int,prefix:string,localName:?string,namespaceURI:?string,baseURI:?string,textContent:string,ownerDocument:?class-string,parentNode:?class-string,parentElement:?class-string,childNodes:array<ItemNode|ItemNodeNS>}
 * @param \DOMNodeList|\DOMNode|\DOMNameSpaceNode $el
 * @return ItemNodeNS[]|ItemNode[]
 */
    static function domToArray(object $el): array {}

        /**
 * @link https://php.net/manual/en/domdocument.load.php
 * @return null|\DOMDocument
 */
    static function loadFile(string $filename, int $options = 0): ?object {}

        /**
 * @param \DOMNode $node
 */
    static function removeNode(object $node): bool {}

        /**
 * @param \DOMNode $node
 */
    static function toHtml(object $node): ?string {}

        /**
 * @param \DOMNode $node
 * @return ?string
 */
    static function toXml(object $node, int $options = 0) {}

        /**
 * @psalm-import-type Param_1_xpathQueryFromDoc from \TypeXml
 * @link https://php.net/manual/en/domxpath.query.php
 * @author inilim
 * @todo tests
 * @param \DOMDocument $doc
 * @param ?\DOMNode $contextNode
 * @return null|Param_1_xpathQueryFromDoc
 */
    static function xpathQueryFromDoc(object $doc, string $expression, ?object $contextNode = null, bool $registerNodeNS = true): ?array {}

    }