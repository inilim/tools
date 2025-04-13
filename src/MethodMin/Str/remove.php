<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function remove($search,$subject,bool $caseSensitive=true){if($search instanceof \Traversable){$search=\iterator_to_array($search);}if($subject instanceof \Traversable){$subject=\iterator_to_array($subject);}return $caseSensitive?\str_replace($search,'',$subject):\str_ireplace($search,'',$subject);}