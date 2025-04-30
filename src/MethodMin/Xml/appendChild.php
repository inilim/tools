<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

function appendChild(\DOMNode $what,\DOMNode $where,bool $throw=false){$doc=$where -> ownerDocument;if($doc===null){if($throw){throw new \DOMException('Failed $where->ownerDocument is null');}else{return null;}}$newWhat=@$doc -> importNode($what,true);if($newWhat===false){if($throw){throw new \DOMException('Failed importNode($what, true)');}else{return null;}}try{$where -> appendChild($newWhat);}catch(\DOMException $e){if($throw){throw $e;}else{return null;}}return $newWhat;}