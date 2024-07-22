<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = ['employee_id', 'text', 'recipient', 'is_sent', 'error'];

    // 👉 Links
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    // 👉 Functions
    public function getMessageSenderPhoto()
    {
        // return User::where('name', $this->updated_by)->first()->profile_photo_path ?? 'storage/profile-photos/.administrator.jpg';

        $sender = User::where('name', $this->updated_by)->first();
        if ($sender) {
            return 'storage/'.$sender->profile_photo_path;
        }

        return 'storage/profile-photos/.administrator.jpg';
    }
}
