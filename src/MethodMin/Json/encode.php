<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function encode($v,int $flags=0,int $depth=512){/*// @phpstan-ignore-next-line*/return \json_encode($v,$flags,$depth);}