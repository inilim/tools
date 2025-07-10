<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function joinKeys(array $iterable,string $separator=','):string{if($iterable instanceof \Traversable){$iterable=\iterator_to_array($iterable);}return \implode($separator,\array_keys($iterable));}