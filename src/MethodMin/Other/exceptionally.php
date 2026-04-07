<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function exceptionally(callable $function,int $errorLevels=\E_ALL&~\E_DEPRECATED&~\E_USER_DEPRECATED){static $handler=null;$handler ??= static function(int $level,string $message,string $file,int $line):bool{static $suppressedLevel=\E_ERROR|\E_CORE_ERROR|\E_COMPILE_ERROR|\E_USER_ERROR|\E_RECOVERABLE_ERROR|\E_PARSE;if(\error_reporting()===$suppressedLevel){return true;}throw new \ErrorException($message,0,$level,$file,$line);};\set_error_handler($handler,$errorLevels);try{return $function();}finally{\restore_error_handler();}}