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
 * @return mixed[]
 */
    static function domToArray(\DOMNode $root) {}

        /**
 * @return ?string
 */
    static function toHtml(\DOMNode $node) {}

        /**
 * @return ?string
 */
    static function toXml(\DOMNode $node, int $options = 0) {}

    }