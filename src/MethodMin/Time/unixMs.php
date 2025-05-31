<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function unixMs():int{$timestamp=\microtime(false);return \intval(\substr($timestamp,11),10)*1000+\intval(\substr($timestamp,2,3),10);}