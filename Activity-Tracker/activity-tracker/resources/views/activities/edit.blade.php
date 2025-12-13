<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Activity</title>

  <style>
    body{
      margin:0;
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
      background: radial-gradient(circle at top,#111827,#020617);
      color:#e5e7eb;
      padding:20px;
    }

    .card{
      width:100%;
      max-width:520px;
      background:rgba(15,23,42,.85);
      border:1px solid rgba(255,255,255,.12);
      border-radius:20px;
      padding:24px;
      box-shadow:
        0 30px 80px rgba(0,0,0,.6),
        inset 0 0 0 1px rgba(255,255,255,.03);
    }

    h3{
      margin:0 0 16px;
      font-size:24px;
      text-align:center;
      background: linear-gradient(135deg,#facc15,#22c55e);
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
    }

    .section{
      margin-bottom:18px;
      padding-bottom:16px;
      border-bottom:1px dashed rgba(255,255,255,.15);
    }

    .section:last-child{
      border-bottom:none;
      padding-bottom:0;
    }

    label{
      display:block;
      margin-bottom:6px;
      font-size:13px;
      color:#9ca3af;
    }

    input, textarea, select{
      width:100%;
      padding:12px 14px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.15);
      background:#020617;
      color:#e5e7eb;
      outline:none;
      transition: all .15s ease;
    }

    textarea{
      resize:vertical;
      min-height:80px;
    }

    input:focus, textarea:focus, select:focus{
      border-color:#22c55e;
      box-shadow:0 0 0 3px rgba(34,197,94,.25);
    }

    select{
      cursor:pointer;
    }

    .actions{
      display:flex;
      gap:12px;
      margin-top:18px;
      flex-wrap:wrap;
    }

    .btn{
      flex:1;
      padding:14px;
      border-radius:16px;
      font-weight:900;
      cursor:pointer;
      border:none;
      font-size:14px;
      transition: transform .15s ease, box-shadow .15s ease;
    }

    .btn-update{
      background: linear-gradient(135deg,#facc15,#22c55e);
      color:#020617;
      box-shadow:0 16px 40px rgba(34,197,94,.35);
    }

    .btn-update:hover{
      transform: translateY(-2px);
      box-shadow:0 22px 60px rgba(34,197,94,.45);
    }

    .btn-back{
      background:rgba(2,6,23,.6);
      color:#e5e7eb;
      border:1px solid rgba(255,255,255,.15);
      text-align:center;
      text-decoration:none;
      display:flex;
      align-items:center;
      justify-content:center;
    }

    .btn-back:hover{
      background:rgba(2,6,23,.8);
    }

    @media(max-width:480px){
      .actions{ flex-direction:column; }
    }
  </style>
</head>

<body>

  <div class="card">
    <h3>Edit Activity Status</h3>

    <form action="/activities/{{ $activity->id }}" method="POST">
      @csrf
      @method('PUT')

      <!-- STATUS -->
      <div class="section">
        <label>Status</label>
        <select name="status" required>
          <option value="pending" {{ $activity->status === 'pending' ? 'selected' : '' }}>
            ⏳ Pending
          </option>
          <option value="done" {{ $activity->status === 'done' ? 'selected' : '' }}>
            ✅ Done
          </option>
        </select>

        <br>

        <label>Remark</label>
        <textarea name="remark" placeholder="Add remark...">{{ $activity->remark }}</textarea>
      </div>

      <!-- BIO DETAILS -->
      <div class="section">
        <label>Your Name</label>
        <input
          type="text"
          name="status_updated_by_name"
          value="{{ $activity->status_updated_by_name }}"
          required
        >

        <br>

        <label>Your Role</label>
        <input
          type="text"
          name="status_updated_by_role"
          value="{{ $activity->status_updated_by_role }}"
          required
        >

        <br>

        <label>Your Email</label>
        <input
          type="email"
          name="status_updated_by_email"
          value="{{ $activity->status_updated_by_email }}"
          required
        >
      </div>

      <!-- ACTIONS -->
      <div class="actions">
        <a href="/activities/daily-updates" class="btn btn-back">← Back</a>
        <button type="submit" class="btn btn-update">Update Activity</button>
      </div>
    </form>
  </div>

</body>
</html>
