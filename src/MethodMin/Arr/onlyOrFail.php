<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function onlyOrFail(array $array,$keys):array{$keys=(array) $keys;$arr=\array_intersect_key($array,\array_flip($keys));if(\count($arr)!==\count($keys)){$missing=\array_diff($keys,\array_keys($array));throw new \Exception('Missing keys: '.\implode(',',$missing));}return $arr;}