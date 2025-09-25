<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

function str_increment(string $string):string{if(''===$string){throw new \Error('PF::str_increment(): Argument #1 ($string) cannot be empty');}if(!\preg_match('/^[a-zA-Z0-9]+$/',$string)){throw new \Error('PF::str_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters');}if(\is_numeric($string)){$offset=\stripos($string,'e');if(false!==$offset){$char=$string[$offset];++$char;$string[$offset]=$char;++$string;switch($string[$offset]){case 'f':$string[$offset]='e';break;case 'F':$string[$offset]='E';break;case 'g':$string[$offset]='f';break;case 'G':$string[$offset]='F';break;}return (string) $string;}}return (string)++$string;}