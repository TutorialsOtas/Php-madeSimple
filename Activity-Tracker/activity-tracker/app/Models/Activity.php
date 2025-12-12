<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'member_name',
        'title',
        'details',
        'sms_count',
        'sms_account_from_logs',
        'activity_date',
        'status',
        'remark',

    ];
}

