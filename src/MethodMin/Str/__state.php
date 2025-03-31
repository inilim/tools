<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function __state(){static $o=null;return $o ?? new class{var $randomStringFactory;};}