<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivitiesReportExport;

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

    // Status/remark updates (already exists)
    $updates = ActivityUpdate::with('activity')
        ->whereDate('updated_at', $date)
        ->orderBy('updated_at', 'desc')
        ->get();

    // NEW: activities created that day
    $activities = Activity::whereDate('created_at', $date)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('activities.daily_updates', compact('updates', 'activities', 'date'));


    }

    // Reporting view by custom duration (Requirement 5)
   public function reports(Request $request)
{
    $from = $request->query('from');
    $to   = $request->query('to');

    $updates = collect();
    $activities = collect();

    $summary = [
        'activities_created' => 0,
        'updates_made'       => 0,
        'pending_as_of_to'   => 0,
        'done_as_of_to'      => 0,
    ];

    if ($from && $to) {
        $fromDT = $from . ' 00:00:00';
        $toDT   = $to . ' 23:59:59';

        $updates = ActivityUpdate::with('activity')
            ->whereBetween('updated_at', [$fromDT, $toDT])
            ->orderBy('updated_at', 'desc')
            ->get();

        $activities = Activity::whereBetween('created_at', [$fromDT, $toDT])
            ->orderBy('created_at', 'desc')
            ->get();

        $summary['activities_created'] = $activities->count();
        $summary['updates_made'] = $updates->count();

        // accumulated (as of end date)
        $summary['pending_as_of_to'] = Activity::where('created_at', '<=', $toDT)
            ->where('status', 'pending')
            ->count();

        $summary['done_as_of_to'] = Activity::where('created_at', '<=', $toDT)
            ->where('status', 'done')
            ->count();
    }

    return view('activities.reports', compact('updates', 'activities', 'from', 'to', 'summary'));
}

public function reportsPdf(Request $request)
{
    $from = $request->query('from');
    $to   = $request->query('to');

    abort_unless($from && $to, 400, 'Please select from/to dates.');

    $fromDT = $from . ' 00:00:00';
    $toDT   = $to . ' 23:59:59';

    $updates = ActivityUpdate::with('activity')
        ->whereBetween('updated_at', [$fromDT, $toDT])
        ->orderBy('updated_at', 'desc')
        ->get();

    $activities = Activity::whereBetween('created_at', [$fromDT, $toDT])
        ->orderBy('created_at', 'desc')
        ->get();

    $summary = [
        'activities_created' => $activities->count(),
        'updates_made'       => $updates->count(),
        'pending_as_of_to'   => Activity::where('created_at', '<=', $toDT)->where('status', 'pending')->count(),
        'done_as_of_to'      => Activity::where('created_at', '<=', $toDT)->where('status', 'done')->count(),
    ];

    $pdf = Pdf::loadView('activities.reports_pdf', compact('from', 'to', 'updates', 'activities', 'summary'))
        ->setPaper('a4', 'portrait');

    return $pdf->download("activity-report-{$from}-to-{$to}.pdf");
}

public function reportsExcel(Request $request)
{
    $from = $request->query('from');
    $to   = $request->query('to');

    abort_unless($from && $to, 400, 'Please select from/to dates.');

    return Excel::download(new ActivitiesReportExport($from, $to), "activity-report-{$from}-to-{$to}.xlsx");
}

}
