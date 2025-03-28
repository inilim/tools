<?php

namespace Inilim\Tool\Method\Str;

function unixNewLines(string $s,string $replacement="\n"):string{return \preg_replace("#\r\n?| | #",$replacement,$s);}