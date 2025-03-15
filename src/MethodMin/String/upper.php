<?php

namespace Inilim\Tool\Method\String;

function upper(string $value,?string $encoding='UTF-8'){return \mb_strtoupper($value,$encoding);}