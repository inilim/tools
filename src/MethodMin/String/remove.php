<?php

namespace Inilim\Tool\Method\String;

function remove($search,$subject,bool $caseSensitive=true){return $caseSensitive?\str_replace($search,'',$subject):\str_ireplace($search,'',$subject);}