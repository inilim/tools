<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp{function excelColCharToNum(string $col):int{if(!\Inilim\Tool\Method\Str\isMatch('#^[a-z]+$#i',$col)){throw new \InvalidArgumentException(\sprintf('Expected only chars. Got: "%s"',$col));}$col=\strtoupper($col);$result=0;$length=\strlen($col);for($i=0;$i<$length;$i++){$char=$col[$i];$result=$result*26+(\ord($char)-\ord('A')+1);}return $result;}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('isMatch')){
    function isMatch($pattern,string $value):bool{if(!\is_iterable($pattern)){$pattern=[$pattern];}foreach($pattern as $pattern){if(\preg_match((string) $pattern,$value)===1){return true;}}return false;}
    }}