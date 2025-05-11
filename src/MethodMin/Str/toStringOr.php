<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function toStringOr($value,string $fallback):string{try{return (string) $value;}catch(\Throwable $e){return $fallback;}}