<?php

namespace Inilim\Tool\Method\LarStr;

function toStringOr($value,$fallback){try{return (string) $value;}catch(\Throwable $e){return $fallback;}}