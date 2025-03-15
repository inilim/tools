<?php

namespace Inilim\Tool\Method\String;

function unixNewLines(string $s,string $replacement="\n"):string{return \preg_replace("#\r\n?| | #",$replacement,$s);}