<?php

namespace Inilim\Tool\Method\LarStr;

function title($value){return \mb_convert_case($value,\MB_CASE_TITLE,'UTF-8');}