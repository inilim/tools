<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Data;

function dateTimePatterns():array{$t=['COOKIE'=>\DateTimeInterface :: COOKIE,'ISO8601'=>'Y-m-d\TH:i:sO','RFC822'=>\DateTimeInterface :: RFC822,'RFC850'=>\DateTimeInterface :: RFC850,'RFC1036'=>\DateTimeInterface :: RFC1036,'RFC1123'=>\DateTimeInterface :: RFC1123,'RFC7231'=>\DateTimeInterface :: RFC7231,'RFC2822'=>\DateTimeInterface :: RFC2822,'RFC3339'=>\DateTimeInterface :: RFC3339,'RFC3339_EXTENDED'=>\DateTimeInterface :: RFC3339_EXTENDED,'RSS'=>\DateTimeInterface :: RSS,'W3C'=>\DateTimeInterface :: W3C,'SQL_FORMAT'=>'Y-m-d H:i:s','ISO8601_EXPANDED'=>'X-m-d\TH:i:sP'];return $t;}