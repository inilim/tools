<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other{function getExceptionDetails(\Throwable $e,bool $traceAsArray=false,bool $dots=false):array{$r=['message'=>$e -> getMessage(),'line'=>$e -> getLine(),'code'=>$e -> getCode(),'file'=>$e -> getFile(),'trace'=>$traceAsArray?$e -> getTrace():$e -> getTraceAsString(),'class'=>\get_class($e)];return $dots?\Inilim\Tool\Method\Other\_refDots($r):$r;}if(!\Inilim\Tool\Other::__definedIfNot('_refDots')){
    function _refDots(array $array):array{$dots=[];foreach($array as&$value){$dots[]=&$value;}$array['...']=$dots;return $array;}
    }}