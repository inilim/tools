<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function isMultidimensional(array $array):bool{foreach($array as $item){if(\is_array($item)){return true;}}return false;}