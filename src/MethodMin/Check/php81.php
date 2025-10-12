<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}