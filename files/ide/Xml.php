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
    static function appendChild(\DOMNode $what, \DOMNode $where, bool $throw = false) {}

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
    static function domToArray(object $el) {}

        
    static function removeNode(\DOMNode $node): bool {}

        /**
 * @return ?string
 */
    static function toHtml(\DOMNode $node) {}

        /**
 * @return ?string
 */
    static function toXml(\DOMNode $node, int $options = 0) {}

    }