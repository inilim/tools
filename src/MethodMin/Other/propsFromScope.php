<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function propsFromScope($scope,array $props):array{if(!$props){return[];}return(function($props){$results=[];foreach($props as $prop){if(\property_exists(self :: class,$prop)){$results[$prop]=self :: ${$prop};}}return $results;})-> bindTo(null,$scope)-> __invoke($props);}