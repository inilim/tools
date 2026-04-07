<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function methodFromScope($scope,string $method,array $args=[]){return(function(string $method,array $args){if(\method_exists(self :: class,$method)){return self :: $method(... $args);}})-> bindTo(null,$scope)-> __invoke($method,$args);}