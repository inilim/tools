<?php

namespace Inilim\Tool\Method\Other;

function getClosureScopeClass(\Closure $cls){/*// $print = \print_r($cls, true);*//*// dde();*/$ref=new \ReflectionFunction($cls);$ref=$ref -> getClosureScopeClass();if($ref===null){return null;}return $ref -> getName();}