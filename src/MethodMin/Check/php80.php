<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}