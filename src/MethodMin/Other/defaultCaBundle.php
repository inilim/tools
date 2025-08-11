<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function defaultCaBundle():string{static $cached=null;if($cached){return $cached;}if($ca=\ini_get('openssl.cafile')){return $cached=$ca;}if($ca=\ini_get('curl.cainfo')){return $cached=$ca;}$cafiles=['/etc/pki/tls/certs/ca-bundle.crt','/etc/ssl/certs/ca-certificates.crt','/usr/local/share/certs/ca-root-nss.crt','/var/lib/ca-certificates/ca-bundle.pem','/usr/local/etc/openssl/cert.pem','/etc/ca-certificates.crt','C:\windows\system32\curl-ca-bundle.crt','C:\windows\curl-ca-bundle.crt'];foreach($cafiles as $filename){if(\is_file($filename)){return $cached=$filename;}}throw new \Exception('No system CA bundle could be found in any of the the common system locations.');}