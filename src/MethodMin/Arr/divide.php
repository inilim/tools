<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function divide(array $array):array{return[\array_keys($array),\array_values($array)];}