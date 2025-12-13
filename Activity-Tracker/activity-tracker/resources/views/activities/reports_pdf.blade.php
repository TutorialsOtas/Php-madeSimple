<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2 { margin: 0 0 10px; }
    .muted { color: #666; margin: 0 0 10px; }
    table { width: 100%; border-collapse: collapse; margin: 10px 0 18px; }
    th, td { border: 1px solid #ddd; padding: 6px; vertical-align: top; }
    th { background: #f3f4f6; }
  </style>
</head>
<body>

  <h2>Activity Report</h2>
  <p class="muted">From <strong>{{ $from }}</strong> to <strong>{{ $to }}</strong></p>

  <p>
    <strong>Summary:</strong>
    Activities Created: {{ $summary['activities_created'] }} |
    Updates Made: {{ $summary['updates_made'] }} |
    Pending (as of end date): {{ $summary['pending_as_of_to'] }} |
    Done (as of end date): {{ $summary['done_as_of_to'] }}
  </p>

  <h3>Activities Created</h3>
  <table>
    <thead>
      <tr>
        <th>DateTime</th>
        <th>Title</th>
        <th>Member</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($activities as $a)
        <tr>
          <td>{{ $a->created_at?->format('Y-m-d H:i') }}</td>
          <td>{{ $a->title }}</td>
          <td>{{ $a->member_name }}</td>
          <td>{{ $a->status ?? 'pending' }}</td>
        </tr>
      @empty
        <tr><td colspan="4">No activities created in this range.</td></tr>
      @endforelse
    </tbody>
  </table>

  <h3>Updates Made</h3>
  <table>
    <thead>
      <tr>
        <th>DateTime</th>
        <th>Activity</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Remark</th>
      </tr>
    </thead>
    <tbody>
      @forelse($updates as $u)
        <tr>
          <td>{{ \Carbon\Carbon::parse($u->updated_at)->format('Y-m-d H:i') }}</td>
          <td>{{ $u->activity->title ?? '-' }}</td>
          <td>{{ $u->updated_by_name }} ({{ $u->updated_by_role }})</td>
          <td>{{ $u->old_status ?? '-' }} → {{ $u->new_status }}</td>
          <td>{{ $u->old_remark ?? '-' }} → {{ $u->new_remark ?? '-' }}</td>
        </tr>
      @empty
        <tr><td colspan="5">No updates in this range.</td></tr>
      @endforelse
    </tbody>
  </table>

</body>
</html>
