<?php

namespace Inilim\Tool\Method\ID;

function uniqEntropy(string $prefix=''){return \uniqid($prefix,true);}