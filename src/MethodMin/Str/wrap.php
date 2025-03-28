<?php

namespace Inilim\Tool\Method\Str;

function wrap(string $value,string $before,?string $after=null):string{return $before.$value.$after ??= $before;}