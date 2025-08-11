<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function strOrArr($value):bool{return \is_string($value)||\is_array($value);}