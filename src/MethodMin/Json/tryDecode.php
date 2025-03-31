<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function tryDecode(string $v,?bool $associative=null,int $depth=512,int $flags=0,$default=null){try{/*// @phpstan-ignore-next-line*/$v=\json_decode($v,$associative,$depth,$flags);}catch(\JsonException $e){return $default;}if(\json_last_error()!==\JSON_ERROR_NONE){return $default;}return $v;}