<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function clearClosure(\Closure $cls){return $cls -> bindTo(null,null);}