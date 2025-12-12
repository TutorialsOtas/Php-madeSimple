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

  <!-- NEW: Bio details -->
  <label>Your Name</label>
  <input
    type="text"
    name="status_updated_by_name"
    value="{{ $activity->status_updated_by_name }}"
    required
  >

  <br><br>

  <label>Your Role</label>
  <input
    type="text"
    name="status_updated_by_role"
    value="{{ $activity->status_updated_by_role }}"
    required
  >

  <br><br>

  <label>Your Email</label>
  <input
    type="email"
    name="status_updated_by_email"
    value="{{ $activity->status_updated_by_email }}"
    required
  >

  <br><br>

  <button type="submit">Update</button>
</form>
