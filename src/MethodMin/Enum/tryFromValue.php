<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum;

function tryFromValue(string $enum,$value,bool $caseInsensitive=false){if(!$this -> existsValues($enum)){return null;}foreach($this -> cases($enum)as $enum){if($this -> uniform($enum -> value,$caseInsensitive)===$this -> uniform($value,$caseInsensitive)){return $enum;}}return null;}