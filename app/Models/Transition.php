<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transition extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = [
        'asset_id',
        'employee_id',
        'handed_date',
        'return_date',
        'center_document_number',
        'reason',
        'note',
    ];

    // 👉 Links
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    // 👉 Functions
    public function getCategory($asset_id)
    {
        $assetId = substr($asset_id, 1);
        $categoryId = ltrim(substr($assetId, 0, 4), '0');

        $category = Category::find($categoryId);

        return $category;
    }

    public function getSubCategory($asset_id)
    {
        $assetId = substr($asset_id, 1);
        $subCategoryId = ltrim(substr($assetId, 4, 4), '0');

        $subCategory = SubCategory::find($subCategoryId);

        return $subCategory;
    }
}
