<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function php83():bool{return \PHP_VERSION_ID>=80300?true:false;}