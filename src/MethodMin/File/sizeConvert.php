<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File{function sizeConvert($bytesOrFile,bool $useBinaryPrefix=false):string{if(!\Inilim\Tool\Method\Check\intOrFloatOrFile($bytesOrFile)){throw new \ValueError(\sprintf('Argument #1 ($bytesOrFile) must be of type int|float|string-path-to-file, %s given in ',\gettype($bytesOrFile)));}if(\is_string($bytesOrFile)){$bytes=\Inilim\Tool\Method\File\size($bytesOrFile);if($bytes===-1){throw new \Exception(\sprintf('Fail open file "%s"',$bytesOrFile));}}else{$bytes=$bytesOrFile;}$units=$useBinaryPrefix?['B','KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB','RiB','QiB']:['B','KB','MB','GB','TB','PB','EB','ZB','YB','RB','QB'];for($i=0;$bytes/1024>0.9&&$i<\sizeof($units)-1;$i++){$bytes /= 1024;}return \sprintf('%s %s',$bytes,$units[$i]);}if(!\Inilim\Tool\File::__definedIfNot('size')){
    function size(string $pathToFile):int{$result=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn()=>\filesize($pathToFile),null);if(!\is_int($result)){$result=-1;}return $result;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('file')){
    function file($value):bool{return \is_string($value)&&\is_file($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('intOrFloat')){
    function intOrFloat($value):bool{return \is_int($value)||\is_float($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('intOrFloatOrFile')){
    function intOrFloatOrFile($value):bool{return \Inilim\Tool\Method\Check\intOrFloat($value)||\Inilim\Tool\Method\Check\file($value);}
    }}