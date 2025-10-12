<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function allArray($value):bool{if(!\is_iterable($value)){return false;}foreach($value as $entry){if(!\is_array($entry)){return false;}}return true;}