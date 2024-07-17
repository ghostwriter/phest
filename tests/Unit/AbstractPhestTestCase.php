<?php

declare(strict_types=1);

namespace Tests\Unit;

use Override;
use PHPUnit\Framework\TestCase;

abstract class AbstractPhestTestCase extends TestCase
{
    /**
     * This method is called before the first test of this test class is run.
     */
    #[Override]
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    /**
     * This method is called after the last test of this test class is run.
     */
    #[Override]
    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }

    /**
     * This method is called before each test.
     */
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Performs assertions shared by all tests of a test case.
     *
     * This method is called between setUp() and test.
     */
    #[Override]
    protected function assertPreConditions(): void
    {
        parent::assertPreConditions();
    }

    /**
     * Performs assertions shared by all tests of a test case.
     *
     * This method is called between test and tearDown().
     */
    #[Override]
    protected function assertPostConditions(): void
    {
        parent::assertPostConditions();
    }

    /**
     * This method is called after each test.
     */
    #[Override]
    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
