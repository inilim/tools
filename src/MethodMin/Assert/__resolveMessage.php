<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert;

function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}