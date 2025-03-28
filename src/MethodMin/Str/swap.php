<?php

namespace Inilim\Tool\Method\Str;

function swap(array $map,string $subject):string{return \strtr($subject,$map);}