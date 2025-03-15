<?php

namespace Inilim\Tool\Method\String;

function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}