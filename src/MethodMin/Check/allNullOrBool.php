<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function allNullOrBool($value):bool{if(!\is_iterable($value)){return false;}foreach($value as $entry){if($entry===null){continue;}if(!\is_bool($entry)){return false;}}return true;}