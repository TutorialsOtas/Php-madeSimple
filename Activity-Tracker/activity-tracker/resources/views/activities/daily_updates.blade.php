<h3>Daily Updates ({{ $date }})</h3>

<form method="GET" action="/activities/daily-updates">
  <input type="date" name="date" value="{{ $date }}">
  <button type="submit">View</button>
</form>

<hr>

@forelse ($updates as $u)
  <p>
    <strong>{{ $u->updated_by_name }}</strong>
    ({{ $u->updated_by_role }}) -
    <em>{{ \Carbon\Carbon::parse($u->updated_at)->format('H:i') }}</em>
  </p>

  <p>
    Activity: <strong>{{ $u->activity->title }}</strong><br>
    Status: {{ $u->old_status ?? '-' }} → <strong>{{ $u->new_status }}</strong><br>
    Remark: {{ $u->old_remark ?? '-' }} → <strong>{{ $u->new_remark ?? '-' }}</strong>
  </p>

  <hr>
@empty
  <p>No updates for this date.</p>
@endforelse
