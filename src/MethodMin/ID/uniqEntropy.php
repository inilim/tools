<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\ID;

function uniqEntropy(string $prefix=''){return \uniqid($prefix,true);}