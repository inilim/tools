<?php

namespace Inilim\Tool\Method\Arr;

function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}