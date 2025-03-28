<?php

namespace Inilim\Tool\Method\Str;

function isMatch($patterns,string $value){if(!\is_iterable($patterns)){$patterns=[$patterns];}foreach($patterns as $pattern){if(\preg_match((string) $pattern,$value)===1){return true;}}return false;}