<?php

namespace Inilim\Tool\Method\Str;

function numbers(string $value):string{return \preg_replace('/[^0-9]/','',$value);}