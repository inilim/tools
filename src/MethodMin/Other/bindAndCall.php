<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function bindAndCall(object $object,\Closure $callback,... $args){return $callback -> bindTo($object,$object)(... $args);}