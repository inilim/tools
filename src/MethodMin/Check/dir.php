<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function dir($value):bool{return \is_string($value)&&\is_dir($value);}