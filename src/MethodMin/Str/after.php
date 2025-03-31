<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function after(string $subject,string $search):string{return $search===''?$subject:\array_reverse(\explode($search,$subject,2))[0];}