<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function unique(array $array):array{return \array_keys(\array_flip($array));}