<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function replaceMatches($pattern,$replace,$subject,int $limit=-1){if($replace instanceof \Closure){return \preg_replace_callback($pattern,$replace,$subject,$limit);}return \preg_replace($pattern,$replace,$subject,$limit);}