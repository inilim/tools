<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function getClosureScopeClass(\Closure $cls){$ref=new \ReflectionFunction($cls);$ref=$ref -> getClosureScopeClass();if($ref===null){return null;}return $ref -> getName();}