<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityUpdate;
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

        return redirect()->back()->with('success', 'Activity saved!');

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

        $now = now();

        // Log history (Requirement 4)
        ActivityUpdate::create([
            'activity_id' => $activity->id,

            'updated_by_name' => $data['status_updated_by_name'],
            'updated_by_role' => $data['status_updated_by_role'],
            'updated_by_email' => $data['status_updated_by_email'],

            'old_status' => $activity->status,
            'new_status' => $data['status'],

            'old_remark' => $activity->remark,
            'new_remark' => $data['remark'] ?? null,
        ]);

        // Update current activity state (Requirements 2 & 3)
        $data['status_updated_at'] = $now;
        $activity->update($data);

        return 'Activity updated!';
    }

    // Daily view of all updates (Requirement 4)
    public function dailyUpdates(Request $request)
    {
        $date = $request->query('date', now()->toDateString());

        $updates = ActivityUpdate::with('activity')
            ->whereDate('updated_at', $date)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('activities.daily_updates', compact('updates', 'date'));
    }

    // Reporting view by custom duration (Requirement 5)
    public function reports(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $updatesQuery = ActivityUpdate::with('activity')
            ->orderBy('updated_at', 'desc');

        if ($from && $to) {
            $updatesQuery->whereBetween('updated_at', [
                $from . ' 00:00:00',
                $to . ' 23:59:59',
            ]);
        }

        $updates = $updatesQuery->get();

        return view('activities.reports', compact('updates', 'from', 'to'));
    }
}
