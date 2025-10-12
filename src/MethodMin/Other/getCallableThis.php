<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function getCallableThis(callable $callable){$type=\gettype($callable);if($type==='object'){if($callable instanceof \Closure){return(new \ReflectionFunction($callable))-> getClosureThis();}return $callable;}elseif($type==='array'&&\is_object($callable[0])){return $callable[0];}return null;}