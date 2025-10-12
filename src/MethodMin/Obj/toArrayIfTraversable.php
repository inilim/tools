<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Obj;

function toArrayIfTraversable($value){if($value instanceof \Traversable){return \iterator_to_array($value);}return $value;}