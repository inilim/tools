<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer;

function __state(){static $o=null;return $o ??= new class{var string $locale='en';var string $currency='USD';};}