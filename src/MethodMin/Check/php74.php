<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function php74():bool{return \PHP_VERSION_ID>=70400?true:false;}