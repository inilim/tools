<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function __resource(string $namespace,string $name){$class=\basename(\dirname(\strtr($namespace,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$class,$name);if(\is_file($name)){return require $name;}return null;}