<?php

namespace Inilim\Tool\Method\String;

function finish(string $value,string $cap):string{return \preg_replace('/(?:'.\preg_quote($cap,'/').')+$/u','',$value).$cap;}