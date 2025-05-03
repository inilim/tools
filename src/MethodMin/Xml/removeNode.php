<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

function removeNode(\DOMNode $node):bool{if(!$node -> ownerDocument){return false;}if($node -> parentNode){try{$node -> parentNode -> removeChild($node);return true;}catch(\DOMException $e){return false;}}return false;}