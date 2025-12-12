<h3>Activity History Report</h3>

<form method="GET" action="/activities/reports">
  <label>From</label>
  <input type="date" name="from" value="{{ $from }}">

  <label>To</label>
  <input type="date" name="to" value="{{ $to }}">

  <button type="submit">Run Report</button>
</form>

<hr>

@if($from && $to)
  <p>Showing updates from <strong>{{ $from }}</strong> to <strong>{{ $to }}</strong></p>
@endif

@forelse ($updates as $u)
  <p>
    <strong>{{ $u->updated_by_name }}</strong>
    ({{ $u->updated_by_role }}) -
    <em>{{ \Carbon\Carbon::parse($u->updated_at)->format('Y-m-d H:i') }}</em>
  </p>

  <p>
    Activity: <strong>{{ $u->activity->title }}</strong><br>
    Status: {{ $u->old_status ?? '-' }} → <strong>{{ $u->new_status }}</strong><br>
    Remark: {{ $u->old_remark ?? '-' }} → <strong>{{ $u->new_remark ?? '-' }}</strong>
  </p>

  <hr>
@empty
  <p>No updates found for that duration.</p>
@endforelse
