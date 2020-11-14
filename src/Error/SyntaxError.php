<?php

declare(strict_types=1);

namespace GraphQL\Error;

use GraphQL\Language\Source;
use function sprintf;

class SyntaxError extends Error
{
    /**
     * @param int    $position
     * @param string $description
     */
    public function __construct(Source $source, $position, $description)
    {
        parent::__construct(
            sprintf('Query 语法错误: %s', $description),
            null,
            $source,
            [$position]
        );
    }
}
