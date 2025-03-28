<?php

namespace Inilim\Tool\Method\Str;

function toStringOr($value,string $fallback){try{return (string) $value;}catch(\Throwable $e){return $fallback;}}