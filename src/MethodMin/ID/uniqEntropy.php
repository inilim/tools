<?php

declare(strict_types=1);namespace Inilim\Tool\Method\ID;

function uniqEntropy(string $prefix=''):string{return \uniqid($prefix,true);}