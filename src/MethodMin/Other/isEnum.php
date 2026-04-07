<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function isEnum($v):bool{if(\PHP_VERSION_ID<80100){return false;}$t=\gettype($v);if($t==='object'){return $v instanceof \UnitEnum;}elseif($t==='string'){return \enum_exists($v);}return false;}