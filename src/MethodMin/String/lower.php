<?php

namespace Inilim\Tool\Method\String;

function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}