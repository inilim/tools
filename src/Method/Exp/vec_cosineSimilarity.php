<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Cosine similarity on array vectors.
 * @param float[] $vectorA
 * @param float[] $vectorB
 */
function vec_cosineSimilarity(array $vectorA, array $vectorB): float
{
    [$vectorA, $normA] = \Inilim\Tool\Method\Exp\vec_normalize($vectorA);
    [$vectorB, $normB] = \Inilim\Tool\Method\Exp\vec_normalize($vectorB);
    $sim = \Inilim\Tool\Method\Exp\vec_dotProduct($vectorA, $vectorB) / ($normA * $normB);
    return \round((float)$sim, 2);
}
