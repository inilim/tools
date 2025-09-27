<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function iteratorToDevNull(\Traversable $iterator):void{foreach($iterator as $_){}}