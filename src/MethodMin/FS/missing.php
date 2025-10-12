<?php

declare(strict_types=1);namespace Inilim\Tool\Method\FS{function missing(string $path):bool{return!\Inilim\Tool\Method\FS\exists($path);}if(!\Inilim\Tool\FS::__definedIfNot('exists')){
    function exists(string $path):bool{return \file_exists($path);}
    }}