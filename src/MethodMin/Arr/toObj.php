<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function toObj(iterable $array,object $object){foreach($array as $k=>&$v){$object ->{$k}=$v;}return $object;}