<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function take(array $array,int $limit):array{if($limit<0){return \array_slice($array,$limit,\abs($limit));}return \array_slice($array,0,$limit);}