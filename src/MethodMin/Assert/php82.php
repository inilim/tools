<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert;

function php82($message=''){if(\PHP_VERSION_ID>=80200){return;}throw new \AssertionError($message?$message:'The current version is lower than required "8.2"');}