<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip;

function __state(){static $o=null;if($o===null){$o=new class{var $existsExtZipArchive;};$o -> existsExtZipArchive=\extension_loaded('zip');}return $o;}