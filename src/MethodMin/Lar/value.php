<?php

namespace Inilim\Tool\Method\Lar;

function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}