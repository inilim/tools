<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function isInstanceOfAny($value,array $classes):bool{foreach($classes as $class){if($value instanceof $class){return true;}}return false;}