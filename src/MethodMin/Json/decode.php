<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Json;

function decode(string $v,?bool $associative=null,int $depth=512,int $flags=0){return \json_decode($v,$associative,$depth,$flags);}