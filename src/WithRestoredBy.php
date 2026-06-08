<?php

namespace Thana\CreateUpdateDeleteBy;

trait WithRestoredBy
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootWithRestoredBy(): void
    {
        static::restoring(static function ($model) {
            $model->restored_by = auth()->id();
        });
    }
}