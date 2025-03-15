<?php

namespace Inilim\Tool\Method\Json;

function tryEncode($v,int $flags=0,int $depth=512,$default=null){try{/*// @phpstan-ignore-next-line*/$json=\json_encode($v,$flags,$depth);}catch(\JsonException $e){return $default;}if($json===false){return $default;}return $json;}