<?php

namespace Thana\CreateUpdateDeleteBy;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\ServiceProvider;

class CreateUpdateDeleteByServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (!Blueprint::hasMacro('createdBy')) {
            Blueprint::macro('createdBy', function () {
                /** @var Blueprint $this */
                $this->foreignIdFor(config('auth.providers.users.model', User::class), 'created_by')
                    ->nullable()
                    ->default(null);
            });
        }
        if (!Blueprint::hasMacro('updatedBy')) {
            Blueprint::macro('updatedBy', function () {
                /** @var Blueprint $this */
                $this->foreignIdFor(config('auth.providers.users.model', User::class), 'updated_by')
                    ->nullable()
                    ->default(null);
            });
        }
        if (!Blueprint::hasMacro('deletedBy')) {
            Blueprint::macro('deletedBy', function () {
                /** @var Blueprint $this */
                $this->foreignIdFor(config('auth.providers.users.model', User::class), 'deleted_by')
                    ->nullable()
                    ->default(null);
            });
        }
        if (!Blueprint::hasMacro('restoredBy')) {
            Blueprint::macro('restoredBy', function () {
                /** @var Blueprint $this */
                $this->foreignIdFor(config('auth.providers.users.model', User::class), 'restored_by')
                    ->nullable()
                    ->default(null);
            });
        }
        if (!Blueprint::hasMacro('restoredAt')) {
            Blueprint::macro('restoredAt', function () {
                /** @var Blueprint $this */
                $this->timestamp('restored_at')->nullable()->default(null);
            });
        }
        if (!Blueprint::hasMacro('dropCreatedBy')) {
            Blueprint::macro('dropCreatedBy', function () {
                /** @var Blueprint $this */
                $this->dropColumn('created_by');
            });
        }
        if (!Blueprint::hasMacro('dropUpdatedBy')) {
            Blueprint::macro('dropUpdatedBy', function () {
                /** @var Blueprint $this */
                $this->dropColumn('updated_by');
            });
        }
        if (!Blueprint::hasMacro('dropDeletedBy')) {
            Blueprint::macro('dropDeletedBy', function () {
                /** @var Blueprint $this */
                $this->dropColumn('deleted_by');
            });
        }
        if (!Blueprint::hasMacro('dropRestoredBy')) {
            Blueprint::macro('dropRestoredBy', function () {
                /** @var Blueprint $this */
                $this->dropColumn('restored_by');
            });
        }
        if (!Blueprint::hasMacro('dropRestoredAt')) {
            Blueprint::macro('dropRestoredAt', function () {
                /** @var Blueprint $this */
                $this->dropColumn('restored_at');
            });
        }
    }

    public function boot() {}
}
