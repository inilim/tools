<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Obj;

function unpuckTraversableRecursive(\Traversable $obj):array{$result=[];$internal=static function(\Traversable $iterator)use(&$internal,&$result){foreach($iterator as $item){if($item instanceof \Traversable){$internal($item);}else{$result[]=$item;}}};$internal($obj);return $result;}