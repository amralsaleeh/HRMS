<?php

namespace App\Traits;

trait CreatedUpdatedDeletedBy
{
    public static function bootCreatedUpdatedDeletedBy()
    {
        if (auth()->user()) {
            // Updating created_by and updated_by when model is created
            static::creating(function ($model) {
                if (! $model->isDirty('created_by')) {
                    $model->created_by = auth()->user()->name;
                }
                if (! $model->isDirty('updated_by')) {
                    $model->updated_by = auth()->user()->name;
                }
            });

            // Updating updated_by when model is updated
            static::updating(function ($model) {
                if (! $model->isDirty('updated_by')) {
                    $model->updated_by = auth()->user()->name;
                }
            });

            // Updating deleted_by when is deleting
            static::deleting(function ($model) {
                if (! $model->isDirty('deleted_by')) {
                    $model->deleted_by = auth()->user()->name;
                    $model->update(['deleted_by' => auth()->user()->name]);
                }
            });
        } else {
            // Updating created_by and updated_by when model is created
            static::creating(function ($model) {
                if (! $model->isDirty('created_by')) {
                    $model->created_by = 'System';
                }
                if (! $model->isDirty('updated_by')) {
                    $model->updated_by = 'System';
                }
            });

            // Updating updated_by when model is updated
            static::updating(function ($model) {
                if (! $model->isDirty('updated_by')) {
                    $model->updated_by = 'System';
                }
            });

            // Updating deleted_by when is deleting
            static::deleting(function ($model) {
                if (! $model->isDirty('deleted_by')) {
                    $model->deleted_by = 'System';
                    $model->update(['deleted_by' => 'System']);
                }
            });
        }
    }
}
