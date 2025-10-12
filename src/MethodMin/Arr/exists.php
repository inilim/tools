<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function exists($array,$key):bool{if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}