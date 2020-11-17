<?php

declare(strict_types=1);

namespace GraphQL\Tests\Executor;

use GraphQL\Executor\ExecutionResult;
use PHPUnit\Framework\TestCase;

class ExecutionResultTest extends TestCase
{
    public function testToArrayWithoutExtensions() : void
    {
        $executionResult = new ExecutionResult();

        self::assertArraySubset([], $executionResult->toArray());
    }

    public function testToArrayExtensions() : void
    {
        $executionResult = new ExecutionResult(null, [], ['foo' => 'bar']);

        self::assertArraySubset(['extensions' => ['foo' => 'bar']], $executionResult->toArray());

        $executionResult->extensions = ['bar' => 'foo'];

        self::assertArraySubset(['extensions' => ['bar' => 'foo']], $executionResult->toArray());
    }
}
