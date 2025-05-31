<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function getExceptionDetails(\Throwable $e,bool $traceAsArray=false):array{return['message'=>$e -> getMessage(),'line'=>$e -> getLine(),'code'=>$e -> getCode(),'file'=>$e -> getFile(),'trace'=>$traceAsArray?$e -> getTrace():$e -> getTraceAsString(),'class'=>\get_class($e)];}