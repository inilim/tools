<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function startsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\Str\_startsWith($haystack,$needle)){return true;}}return false;}if(!\Inilim\Tool\Str::__definedIfNot('_startsWith')){
    function _startsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}