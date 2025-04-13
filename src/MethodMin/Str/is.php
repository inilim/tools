<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function is($pattern,string $value,$ignoreCase=false){if(!\is_iterable($pattern)){$pattern=[$pattern];}foreach($pattern as $pattern){$pattern=(string) $pattern;if($pattern==='*'||$pattern===$value){return true;}if($ignoreCase&&\mb_strtolower($pattern)===\mb_strtolower($value)){return true;}$pattern=\preg_quote($pattern,'#');$pattern=\str_replace('\*','.*',$pattern);if(\preg_match('#^'.$pattern.'\z#'.($ignoreCase?'isu':'su'),$value)===1){return true;}}return false;}