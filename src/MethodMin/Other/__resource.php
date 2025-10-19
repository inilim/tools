<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function __resource(string $class,string $name){$_class=\basename(\dirname(\strtr($class,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$_class,$name);if(\is_file($name)){return require $name;}return null;}