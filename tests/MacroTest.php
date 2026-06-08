<?php

namespace Thana\CreateUpdateDeleteBy\Tests;

use Orchestra\Testbench\TestCase;
use Thana\CreateUpdateDeleteBy\CreateUpdateDeleteByServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class MacroTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            CreateUpdateDeleteByServiceProvider::class,
        ];
    }

    /** @test */
    public function test_it_registers_macros()
    {
        $this->assertTrue(Blueprint::hasMacro('createdBy'));
        $this->assertTrue(Blueprint::hasMacro('updatedBy'));
        $this->assertTrue(Blueprint::hasMacro('deletedBy'));
        $this->assertTrue(Blueprint::hasMacro('restoredBy'));
        $this->assertTrue(Blueprint::hasMacro('restoredAt'));
        $this->assertTrue(Blueprint::hasMacro('dropCreatedBy'));
        $this->assertTrue(Blueprint::hasMacro('dropUpdatedBy'));
        $this->assertTrue(Blueprint::hasMacro('dropDeletedBy'));
        $this->assertTrue(Blueprint::hasMacro('dropRestoredBy'));
        $this->assertTrue(Blueprint::hasMacro('dropRestoredAt'));
    }
}
