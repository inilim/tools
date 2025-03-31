<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

function php84($message=''){if(\PHP_VERSION_ID>=80400){return;}throw new \AssertionError($message?$message:'The current version is lower than required "8.4"');}