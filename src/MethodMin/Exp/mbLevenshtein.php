<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

function mbLevenshtein(string $str1,string $str2){$len1=\mb_strlen($str1,'UTF-8');$len2=\mb_strlen($str2,'UTF-8');if($len1<$len2){return \Inilim\Tool\Method\Exp\mbLevenshtein($str2,$str1);}if($len1===0){return $len2;}if($str1===$str2){return 0;}$prevRow=\range(0,$len2);for($i=0;$i<$len1;$i++){$currentRow=[];$currentRow[0]=$i+1;$c1=\mb_substr($str1,$i,1,'UTF-8');for($j=0;$j<$len2;$j++){$c2=\mb_substr($str2,$j,1,'UTF-8');$insertions=$prevRow[$j+1]+1;$deletions=$currentRow[$j]+1;$substitutions=$prevRow[$j]+($c1!==$c2?1:0);$currentRow[]=\min($insertions,$deletions,$substitutions);}$prevRow=$currentRow;}return $prevRow[$len2];}