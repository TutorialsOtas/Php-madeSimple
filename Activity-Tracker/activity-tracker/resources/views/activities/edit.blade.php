<h3>Edit Activity Status</h3>

<form action="/activities/{{ $activity->id }}" method="POST">
  @csrf
  @method('PUT')

  <label>Status</label>
  <select name="status" required>
    <option value="pending" {{ $activity->status === 'pending' ? 'selected' : '' }}>Pending</option>
    <option value="done" {{ $activity->status === 'done' ? 'selected' : '' }}>Done</option>
  </select>

  <br><br>

  <label>Remark</label>
  <textarea name="remark" placeholder="Add remark...">{{ $activity->remark }}</textarea>

  <br><br>

  <button type="submit">Update</button>
</form>
