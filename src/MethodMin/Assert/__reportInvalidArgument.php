<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert;

function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}