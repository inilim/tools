<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

function iteratorAgg($value):bool{if($value instanceof \IteratorAggregate){return true;}return false;}