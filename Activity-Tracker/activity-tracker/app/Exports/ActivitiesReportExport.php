<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivitiesReportExport implements FromCollection, WithHeadings
{
    public function __construct(private string $from, private string $to) {}

    public function headings(): array
    {
        return [
            'Type', 'DateTime', 'Activity Title', 'Member Name',
            'Updated By', 'Role', 'Email',
            'Old Status', 'New Status', 'Old Remark', 'New Remark'
        ];
    }

    public function collection(): Collection
    {
        $fromDT = $this->from . ' 00:00:00';
        $toDT   = $this->to . ' 23:59:59';

        $rows = [];

        // Activities created
        $activities = Activity::whereBetween('created_at', [$fromDT, $toDT])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($activities as $a) {
            $rows[] = [
                'Activity Created',
                $a->created_at?->format('Y-m-d H:i'),
                $a->title,
                $a->member_name,
                '-', '-', '-',
                '-', $a->status ?? 'pending',
                '-', $a->remark ?? '-',
            ];
        }

        // Updates made
        $updates = ActivityUpdate::with('activity')
            ->whereBetween('updated_at', [$fromDT, $toDT])
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($updates as $u) {
            $rows[] = [
                'Activity Updated',
                $u->updated_at?->format('Y-m-d H:i'),
                optional($u->activity)->title ?? '-',
                optional($u->activity)->member_name ?? '-',
                $u->updated_by_name,
                $u->updated_by_role,
                $u->updated_by_email,
                $u->old_status ?? '-',
                $u->new_status ?? '-',
                $u->old_remark ?? '-',
                $u->new_remark ?? '-',
            ];
        }

        return collect($rows);
    }
}
