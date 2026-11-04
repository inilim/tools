<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert;

function __strlen(string $value):int{if(!\function_exists('mb_detect_encoding')){return \strlen($value);}if(false===$encoding=\mb_detect_encoding($value)){return \strlen($value);}return \mb_strlen($value,$encoding);}