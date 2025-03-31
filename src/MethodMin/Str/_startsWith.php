<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function _startsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}