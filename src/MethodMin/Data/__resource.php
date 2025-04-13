<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

function __resource(string $name){if(\is_file($name=__DIR__.'/../../../files/resources/data/'.$name.'.php')){return require $name;}return null;}