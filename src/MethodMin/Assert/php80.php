<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

function php80(string $message=''){if(\PHP_VERSION_ID>=80000){return;}throw new \AssertionError($message?:'The current version is lower than required "8.0"');}