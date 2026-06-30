<?php

namespace Inilim\Tool\Method\LarStr;

function substr($string,$start,$length=null,$encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}