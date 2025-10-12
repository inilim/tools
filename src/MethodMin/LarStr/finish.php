<?php

namespace Inilim\Tool\Method\LarStr;

function finish($value,$cap){$quoted=\preg_quote($cap,'/');return \preg_replace('/(?:'.$quoted.')+$/u','',$value).$cap;}