<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str{function betweenFirst(string $subject,string $from,string $to):string{if($from===''||$to===''){return $subject;}return \Inilim\Tool\Method\Str\before(\Inilim\Tool\Method\Str\after($subject,$from),$to);}if(!\Inilim\Tool\Str::__definedIfNot('after')){
    function after(string $subject,string $search):string{return $search===''?$subject:\array_reverse(\explode($search,$subject,2))[0];}
    }if(!\Inilim\Tool\Str::__definedIfNot('before')){
    function before(string $subject,string $search):string{if($search===''){return $subject;}$result=\strstr($subject,$search,true);return $result===false?$subject:$result;}
    }}