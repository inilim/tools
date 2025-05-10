<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File{function size($bytesOrFile,bool $useBinaryPrefix=false):string{if(!\Inilim\Tool\Method\Check\intOrFloatOrFile($bytesOrFile)){throw new \ValueError(\sprintf('Argument #1 ($bytesOrFile) must be of type int|float|string-path-to-file, %s given in ',\gettype($bytesOrFile)));}if(\is_string($bytesOrFile)){$bytes=@\filesize($bytesOrFile);if($bytes===false){throw new \Exception(\sprintf('Fail open file "%s"',$bytesOrFile));}}else{$bytes=$bytesOrFile;}$units=$useBinaryPrefix?['B','KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB','RiB','QiB']:['B','KB','MB','GB','TB','PB','EB','ZB','YB','RB','QB'];for($i=0;$bytes/1024>0.9&&$i<\sizeof($units)-1;$i++){$bytes /= 1024;}return \sprintf('%s %s',$bytes,$units[$i]);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('file')){
    function file($value):bool{return \is_string($value)&&\is_file($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('intOrFloat')){
    function intOrFloat($value):bool{return \is_int($value)||\is_float($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('intOrFloatOrFile')){
    function intOrFloatOrFile($value):bool{return \Inilim\Tool\Method\Check\intOrFloat($value)||\Inilim\Tool\Method\Check\file($value);}
    }}