<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @template Attrs of array<string,string>
 * @template ItemNodeNS of array{nodeName:string,nodeValue:?string,nodeType:int,prefix:string,localName:?string,namespaceURI:?string,isConnected:bool,ownerDocument:?class-string,parentNode:?class-string,parentElement:?class-string}
 * @template ItemNode of array{attributes:Attrs,nodeName:string,nodeValue:?string,nodeType:int,prefix:string,localName:?string,namespaceURI:?string,baseURI:?string,textContent:string,ownerDocument:?class-string,parentNode:?class-string,parentElement:?class-string,childNodes:array<ItemNode|ItemNodeNS>}
 * @param \DOMNodeList|\DOMNode|\DOMNameSpaceNode $el
 * @return ItemNodeNS[]|ItemNode[]
 */
function domToArray(object $el)
{
    $array = [];

    $fn = static function ($el) use (&$fn) {
        $array = [];
        /**
         * @var \DOMNode|\DOMNameSpaceNode $el
         * @var \Closure $fn
         */

        if ($el instanceof \DOMNode) {
            // ---------------------------------------------
            // list attributes
            // ---------------------------------------------

            if ($el->hasAttributes()) {
                $_attributes = [];
                foreach ($el->attributes as $attribute) {
                    $_attributes[$attribute->name] = $attribute->value;
                }
                if ($_attributes) {
                    $array['attributes'] = $_attributes;
                }
                unset($_attributes);
            }

            // ---------------------------------------------
            // props
            // ---------------------------------------------

            $array += [
                'nodeName'      => $el->nodeName,
                'nodeValue'     => $el->nodeValue,
                'nodeType'      => $el->nodeType,
                'prefix'        => $el->prefix,
                'localName'     => $el->localName,
                'namespaceURI'  => $el->namespaceURI,
                'baseURI'       => $el->baseURI,
                'textContent'   => $el->textContent,
                'ownerDocument' => $el->ownerDocument                     ? \get_class($el->ownerDocument) : null,
                'parentNode'    => $el->parentNode                        ? \get_class($el->parentNode)    : null,
                'parentElement' => \is_object($el->parentElement ?? null) ? \get_class($el->parentElement) : null,
            ];

            // ---------------------------------------------
            // childs
            // ---------------------------------------------

            if ($el->hasChildNodes()) {
                $children  = $el->childNodes;
                $length    = $children->length;
                $_children = [];
                for ($i = 0; $i < $length; $i++) {
                    $child = $fn($children->item($i));
                    //don't keep textnode with only spaces and newline
                    if (!empty($child)) {
                        $_children[] = $child;
                    }
                } // endfor
                if ($_children) {
                    $array['childNodes'] = $_children;
                }
                unset($_children);
            }
        } elseif ($el instanceof \DOMNameSpaceNode) {
            $array = [
                'nodeName'      => $el->nodeName,
                'nodeValue'     => $el->nodeValue,
                'nodeType'      => $el->nodeType,
                'prefix'        => $el->prefix,
                'localName'     => $el->localName,
                'namespaceURI'  => $el->namespaceURI,
                'isConnected'   => $el->isConnected,
                'ownerDocument' => $el->ownerDocument ? \get_class($el->ownerDocument) : null,
                'parentNode'    => $el->parentNode    ? \get_class($el->parentNode)    : null,
                'parentElement' => $el->parentElement ? \get_class($el->parentElement) : null,
            ];
        }
    };

    if ($el instanceof \DOMNodeList) {
        foreach ($el as $item) {
            $array[] = $fn($item);
        }
    } elseif ($el instanceof \DOMNode || $el instanceof \DOMNameSpaceNode) {
        $array[] = $fn($el);
    }

    return $array;
}
