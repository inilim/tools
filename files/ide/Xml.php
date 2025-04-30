<?php

namespace Inilim\Tool;

class Xml
{
        /**
 * @return \DOMElement
 * @throws \DOMException
 */
    static function createEl(string $qualifiedName, ?string $value = null, string $encoding = 'UTF-8', string $namespace = '') {}

        /**
 * @return ?string
 */
    static function toHtml(\DOMNode $node) {}

        /**
 * @return ?string
 */
    static function toXml(\DOMNode $node, int $options = 0) {}

    }