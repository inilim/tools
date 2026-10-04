<?php

namespace Inilim\Tool\Method\LarStr;

function finish($value,$cap){if($cap===''){return $value;}if(!\str_ends_with($value,$cap)){return $value.$cap;}if(!\str_ends_with($value,$cap.$cap)){return $value;}$quoted=\preg_quote($cap,'/');return \preg_replace('/(?:'.$quoted.')+$/u','',$value).$cap;}