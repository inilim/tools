<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function value($value,... $args){return $value instanceof \Closure?$value(... $args):$value;}