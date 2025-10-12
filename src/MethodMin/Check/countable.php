<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function countable($value):bool{if(!\is_array($value)&&!$value instanceof \Countable&&!$value instanceof \ResourceBundle&&!$value instanceof \SimpleXMLElement){return false;}return true;}