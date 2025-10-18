<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function allInArray($value,array $values):bool{if(!\is_iterable($value)){return false;}foreach($value as $entry){if(!\in_array($entry,$values,true)){return false;}}return true;}