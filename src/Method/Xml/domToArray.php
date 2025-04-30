<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @return mixed[]
 */
function domToArray(\DOMNode $root)
{
    $array = [];

    //list attributes
    if ($root->hasAttributes()) {
        $_attributes = [];
        foreach ($root->attributes as $attribute) {
            $_attributes[$attribute->name] = $attribute->value;
        }
        if ($_attributes) {
            $array['_attributes'] = $_attributes;
        }
        unset($_attributes);
    }

    $nodeType = $root->nodeType;

    //handle classic node
    if ($nodeType === \XML_ELEMENT_NODE) {
        $array['_type'] = $root->nodeName;
        if ($root->hasChildNodes()) {
            $children  = $root->childNodes;
            $length    = $children->length;
            $_children = [];
            for ($i = 0; $i < $length; $i++) {
                $child = \Inilim\Tool\Method\Xml\domToArray($children->item($i));

                //don't keep textnode with only spaces and newline
                if (!empty($child)) {
                    $_children[] = $child;
                }
            } // endfor
            if ($_children) {
                $array['_children'] = $_children;
            }
            unset($_children);
        }

        //handle text node
    } elseif ($nodeType === \XML_TEXT_NODE || $nodeType === \XML_CDATA_SECTION_NODE) {
        $value = $root->nodeValue;
        if (!empty($value)) {
            $array['_type']    = '_text';
            $array['_content'] = $value;
        }
    }

    return $array;
}
