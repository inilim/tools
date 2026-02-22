<?php

namespace Inilim\Tool\Method\LarStr;

function ucwords($string,$separators=" \t\r\n\f\v"){$pattern='/(^|['.\preg_quote($separators,'/').'])(\p{Ll})/u';return \preg_replace_callback($pattern,function($matches){return $matches[1].\mb_strtoupper($matches[2]);},$string);}