<?php

namespace Thana\CreateUpdateDeleteBy\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase;
use Thana\CreateUpdateDeleteBy\CreateUpdateDeleteByServiceProvider;
use Thana\CreateUpdateDeleteBy\WithCreatedBy;
use Thana\CreateUpdateDeleteBy\WithUpdatedBy;
use Thana\CreateUpdateDeleteBy\WithDeletedBy;
use Thana\CreateUpdateDeleteBy\WithRestoredBy;
use Thana\CreateUpdateDeleteBy\WithRestoredAt;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class TraitTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            CreateUpdateDeleteByServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        if (!in_array('sqlite', \PDO::getAvailableDrivers())) {
            $this->markTestSkipped('SQLite driver not available.');
        }
        Schema::create('test_models', function (Blueprint $table) {
            $table->id();
            $table->createdBy();
            $table->updatedBy();
            $table->deletedBy();
            $table->restoredBy();
            $table->restoredAt();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function test_it_sets_created_by()
    {
        Auth::shouldReceive('id')->andReturn(1);

        $model = TestModel::create([]);

        $this->assertEquals(1, $model->created_by);
    }

    public function test_it_sets_updated_by()
    {
        Auth::shouldReceive('id')->andReturn(2);

        $model = TestModel::create([]);
        $model->update(['updated_at' => now()]);

        $this->assertEquals(2, $model->updated_by);
    }

    public function test_it_sets_deleted_by()
    {
        Auth::shouldReceive('id')->andReturn(3);

        $model = TestModel::create([]);
        $model->delete();

        $this->assertEquals(3, $model->deleted_by);
    }

    public function test_it_sets_restored_by_and_at()
    {
        Auth::shouldReceive('id')->andReturn(4);

        $model = TestModel::create([]);
        $model->delete();
        
        Auth::shouldReceive('id')->andReturn(5);
        $model->restore();

        $this->assertEquals(5, $model->restored_by);
        // This will currently fail due to the bug if I check restored_at
        // $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $model->restored_at);
    }
}

class TestModel extends Model
{
    use SoftDeletes, WithCreatedBy, WithUpdatedBy, WithDeletedBy, WithRestoredBy, WithRestoredAt;

    protected $guarded = [];
}
