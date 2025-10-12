<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function getKeyOffset(array $array,$key){$value=\array_search(\key([$key=>null]),\array_keys($array),true);return $value===false?null:$value;}