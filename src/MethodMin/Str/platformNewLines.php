<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str{function platformNewLines(string $s):string{return \Inilim\Tool\Method\Str\unixNewLines($s,\PHP_EOL);}if(!\Inilim\Tool\Str::__definedIfNot('unixNewLines')){
    function unixNewLines(string $s,string $replacement="\n"):string{return \preg_replace("#\r\n?| | #",$replacement,$s);}
    }}