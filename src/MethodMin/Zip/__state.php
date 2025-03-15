<?php

namespace Inilim\Tool\Method\Zip;

function __state(){static $o=null;if($o===null){$o=new class{/***@varbool*/var $existsExtZipArchive;};$o -> existsExtZipArchive=\extension_loaded('zip');}return $o;}