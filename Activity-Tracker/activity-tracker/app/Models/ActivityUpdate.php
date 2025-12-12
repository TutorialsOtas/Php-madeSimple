<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityUpdate extends Model
{
    protected $fillable = [
        'activity_id',
        'updated_by_name',
        'updated_by_role',
        'updated_by_email',
        'old_status',
        'new_status',
        'old_remark',
        'new_remark',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
