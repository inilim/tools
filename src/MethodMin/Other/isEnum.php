<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function isEnum($v):bool{if(\PHP_VERSION_ID<80100){return false;}if(\is_object($v)){return $v instanceof \UnitEnum;}elseif(\is_string($v)){return \enum_exists($v);}return false;}