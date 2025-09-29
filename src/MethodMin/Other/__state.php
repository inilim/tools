<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}