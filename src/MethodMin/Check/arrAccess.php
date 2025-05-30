<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function arrAccess($value):bool{if($value instanceof \ArrayAccess){return true;}return false;}