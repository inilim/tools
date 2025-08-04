<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function toCharsGenerator():\Closure{if(\func_num_args()!==0){throw new \InvalidArgumentException('toCharsGenerator()(...) <-- The arguments were passed to the wrong place');}return static function(string&$string,int $chunkSize=1,array $opts=[]):\Generator{$opts['encoding']??= 'UTF-8';$len=\mb_strlen($string,$opts['encoding']);if($len<=0){return;}$countChunks=\floatval($len/$chunkSize);$iteration=0;$chunk=null;$opts['nextChunkSize']??= $chunkSize;for($pos=0;$pos<$len;$pos += $chunkSize){$chunks=\mb_substr($string,$pos,$chunkSize+$opts['nextChunkSize'],$opts['encoding']);$nextChunk=\mb_substr($chunks,$pos+$chunkSize,$opts['nextChunkSize'],$opts['encoding']);$chunk=\mb_substr($chunks,$pos,$chunkSize,$opts['encoding']);$chunks='';yield['iteration'=>$iteration,'countChunks'=>$countChunks,'startPos'=>$pos,'prevChunk'=>$chunk,'nextChunk'=>$nextChunk,'opts'=>$opts]=>$chunk;$iteration++;}};}