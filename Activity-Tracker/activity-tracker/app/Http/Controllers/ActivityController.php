<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_name' => ['required', 'string'],
            'title' => ['required', 'string'],
            'details' => ['nullable', 'string'],
            'sms_count' => ['nullable', 'integer'],
            'sms_account_from_logs' => ['nullable', 'integer'],
            'activity_date' => ['required', 'date'],
        ]);

        Activity::create($data);

        return 'Activity saved!';
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,done'],
            'remark' => ['nullable', 'string'],

            'status_updated_by_name' => ['required', 'string'],
            'status_updated_by_role' => ['required', 'string'],
            'status_updated_by_email' => ['required', 'email'],
        ]);

        $data['status_updated_at'] = now();

        $activity->update($data);

        return 'Activity updated!';
    }
}
