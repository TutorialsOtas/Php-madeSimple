<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Activity Reports</title>

  <style>
    body{
      margin:0;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
      background:#0b1020;
      color:#e5e7eb;
      min-height:100vh;
      padding:24px;
    }

    h3{
      margin:0 0 12px;
      font-size:22px;
      background: linear-gradient(135deg,#facc15,#22c55e);
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
    }

    .card{
      border:1px solid rgba(255,255,255,.12);
      background:rgba(15,23,42,.75);
      border-radius:18px;
      padding:16px;
      box-shadow:0 20px 60px rgba(0,0,0,.6);
    }

    .nav-actions{
      display:flex;
      gap:10px;
      margin-bottom:14px;
      flex-wrap:wrap;
      align-items:center;
    }

    .nav-btn{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding:10px 14px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(2,6,23,.45);
      color:#e5e7eb;
      font-size:13px;
      font-weight:800;
      cursor:pointer;
      text-decoration:none;
      transition: all .15s ease;
    }

    .nav-btn:hover{
      background:rgba(2,6,23,.65);
      transform: translateY(-1px);
    }

    .nav-btn:active{
      transform: translateY(1px);
    }

    .nav-btn.home{
      background:linear-gradient(135deg,#facc15,#22c55e);
      color:#0b1020;
      border:none;
      box-shadow:0 10px 30px rgba(34,197,94,.25);
    }

    .filter{
      display:flex;
      gap:12px;
      flex-wrap:wrap;
      align-items:end;
      margin-bottom:16px;
    }

    label{
      font-size:13px;
      color:#9ca3af;
      display:block;
      margin-bottom:4px;
    }

    input[type="date"]{
      padding:10px 12px;
      border-radius:12px;
      border:1px solid rgba(255,255,255,.14);
      background:#020617;
      color:#e5e7eb;
      outline:none;
    }

    button.run{
      padding:12px 16px;
      border-radius:14px;
      border:none;
      font-weight:900;
      cursor:pointer;
      color:#0b1020;
      background:linear-gradient(135deg,#facc15,#22c55e);
      box-shadow:0 14px 40px rgba(34,197,94,.3);
    }

    .layout{
      display:grid;
      grid-template-columns: 2fr 1fr;
      gap:16px;
      margin-top:16px;
    }

    .preview{
      max-height:520px;
      overflow:auto;
      padding-right:6px;
    }

    .entry{
      border:1px solid rgba(255,255,255,.1);
      background:rgba(2,6,23,.4);
      border-radius:14px;
      padding:12px;
      margin-bottom:12px;
    }

    .actions{
      display:grid;
      gap:12px;
    }

    .action-btn{
      padding:14px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(2,6,23,.45);
      color:#e5e7eb;
      font-weight:800;
      cursor:pointer;
      text-align:center;
      text-decoration: none; 
      display: block;

    }

    @media (max-width: 900px){
      .layout{ grid-template-columns:1fr; }
    }
  </style>
</head>

<body>

  <div class="card">
    <h3>Activity History Report</h3>

    <!-- ✅ FIXED NAVIGATION -->
    <div class="nav-actions">
      <!-- Back → Daily Updates -->
      <a href="/activities/daily-updates" class="nav-btn">
        ← Daily Updates
      </a>

      <!-- Home → Dashboard -->
      <a href="/dashboard" class="nav-btn home">
        🏠 Home
      </a>
    </div>

    <form method="GET" action="/activities/reports" class="filter">
      <div>
        <label>From</label>
        <input type="date" name="from" value="{{ $from }}">
      </div>

      <div>
        <label>To</label>
        <input type="date" name="to" value="{{ $to }}">
      </div>

      <button class="run" type="submit">Run Report</button>
    </form>
  </div>

  <div class="layout">

    <!-- PREVIEW -->
    <div class="card preview">
      @forelse ($updates as $u)
        <div class="entry">
          <strong>{{ $u->updated_by_name }} ({{ $u->updated_by_role }})</strong><br>
          <em>{{ \Carbon\Carbon::parse($u->updated_at)->format('Y-m-d H:i') }}</em><br>
          Activity: <strong>{{ $u->activity->title }}</strong><br>
          Status: {{ $u->old_status ?? '-' }} → <strong>{{ $u->new_status }}</strong><br>
          Remark: {{ $u->old_remark ?? '-' }} → <strong>{{ $u->new_remark ?? '-' }}</strong>
        </div>
      @empty
        <p>No updates found.</p>
      @endforelse
    </div>

    <!-- ACTIONS -->
    <div class="card actions">
     <a class="action-btn" href="/activities/reports/pdf?from={{ $from }}&to={{ $to }}">📄 Download PDF</a>
<a class="action-btn" href="/activities/reports/excel?from={{ $from }}&to={{ $to }}">📊 Download Excel</a>
<div class="action-btn" onclick="window.print()">🖨️ Print</div>

    </div>

  </div>

</body>
</html>
