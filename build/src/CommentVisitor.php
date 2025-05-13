<?php

namespace Inilim\Tool\Build;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class CommentVisitor extends NodeVisitorAbstract
{
    function leaveNode(Node $node)
    {
        // Удаляем комментарии из узла (если они есть)
        if ($node->getAttribute('comments')) {
            // $node->setDocComment(new \PhpParser\Comment\Doc(''));
            $node->setAttribute('comments', []);
            // de($node);
        }
        return null; // Не изменяем сам узел
    }
}
