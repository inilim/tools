<?php

namespace Inilim\Tool\Method\Refl;

function attrMethod(\ReflectionMethod $method){if(\PHP_VERSION_ID<80000){return null;}return $method -> getAttributes();}