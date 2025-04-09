<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function limit(string $value,int $limit=100,string $end='...',bool $preserveWords=false){if(\mb_strwidth($value,'UTF-8')<=$limit){return $value;}if(!$preserveWords){return \rtrim(\mb_strimwidth($value,0,$limit,'','UTF-8')).$end;}$value=\trim(\preg_replace('/[\n\r]+/',' ',\strip_tags($value)));$trimmed=\rtrim(\mb_strimwidth($value,0,$limit,'','UTF-8'));if(\mb_substr($value,$limit,1,'UTF-8')===' '){return $trimmed.$end;}return \preg_replace("/(.*)\\s.*/",'$1',$trimmed).$end;}