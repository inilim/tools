<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function isIterable($value):bool{return \is_array($value)||$value instanceof \Traversable;}