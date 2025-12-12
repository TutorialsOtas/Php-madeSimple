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
        Activity::create([
            'member_name' => $request->member_name,
            'title' => $request->title,
            'details' => $request->details,
            'sms_count' => $request->sms_count,
            'sms_account_from_logs' => $request->sms_account_from_logs,
            'activity_date' => $request->activity_date,
        ]);

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
    ]);

    $activity->update($data);

    return 'Activity updated!';
}


}
