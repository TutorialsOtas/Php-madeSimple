<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daily Updates</title>

  <style>
    :root{
      --bg1:#0b1020;
      --bg2:#0f1b2d;
      --card: rgba(15,23,42,.78);
      --line: rgba(255,255,255,.12);
      --text:#e5e7eb;
      --muted:#9ca3af;

      --yellow:#facc15;
      --green:#22c55e;

      --radius: 18px;
      --shadow: 0 26px 80px rgba(0,0,0,.65);
    }

    *{ box-sizing:border-box; }

    body{
      margin:0;
      min-height:100vh;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
      color: var(--text);
      background:
        radial-gradient(800px 520px at 15% 10%, rgba(250,204,21,.14), transparent 60%),
        radial-gradient(750px 520px at 85% 20%, rgba(34,197,94,.16), transparent 58%),
        linear-gradient(180deg, var(--bg1), var(--bg2));
      padding: 24px;
    }

    .wrap{
      max-width: 1120px;
      margin: 0 auto;
      display: grid;
      gap: 16px;
    }

    .topbar{
      display:flex;
      justify-content: space-between;
      align-items:center;
      gap: 12px;
      padding: 14px 16px;
      border: 1px solid var(--line);
      border-radius: var(--radius);
      background: rgba(15,23,42,.55);
      backdrop-filter: blur(14px);
      box-shadow: var(--shadow);
    }

    .title h3{
      margin:0;
      font-size: 20px;
      letter-spacing: -.02em;
      background: linear-gradient(135deg, var(--yellow), var(--green));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .title p{
      margin: 4px 0 0;
      color: var(--muted);
      font-size: 13px;
    }

    .links{
      display:flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .link{
      color: rgba(229,231,235,.85);
      text-decoration:none;
      font-size: 13px;
      border: 1px solid rgba(255,255,255,.12);
      padding: 8px 10px;
      border-radius: 999px;
      background: rgba(2,6,23,.35);
    }
    .link:hover{ color:white; }

    .grid{
      display:grid;
      grid-template-columns: 1.4fr .9fr;
      gap: 16px;
      align-items: start;
    }

    .card{
      position: relative;
      border-radius: var(--radius);
      border: 1px solid var(--line);
      background: var(--card);
      backdrop-filter: blur(16px);
      box-shadow: var(--shadow);
      overflow: hidden;
      padding: 16px;
    }

    /* mouse-follow glow */
    .card::before{
      content:"";
      position:absolute;
      inset:-2px;
      background:
        radial-gradient(600px 300px at var(--mx, 50%) var(--my, 30%),
          rgba(250,204,21,.18),
          rgba(34,197,94,.12) 35%,
          transparent 65%);
      filter: blur(18px);
      opacity: .85;
      z-index: 0;
      pointer-events:none;
    }

    .content{ position: relative; z-index:1; }

    .card-head{
      display:flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
    }

    .card-head h4{
      margin:0;
      font-size: 15px;
      letter-spacing: -.01em;
    }

    .filter{
      display:flex;
      gap: 10px;
      align-items:center;
      flex-wrap: wrap;
    }

    input[type="date"]{
      padding: 10px 12px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.14);
      background: rgba(2,6,23,.55);
      color: var(--text);
      outline:none;
    }
    input[type="date"]:focus{
      border-color: rgba(34,197,94,.65);
      box-shadow: 0 0 0 4px rgba(34,197,94,.16);
    }

    .btn{
      position: relative;
      overflow:hidden;
      border:none;
      border-radius: 12px;
      padding: 10px 14px;
      cursor:pointer;
      font-weight: 900;
      color: #0b1020;
      background: linear-gradient(135deg, var(--yellow), var(--green));
      box-shadow: 0 14px 35px rgba(34,197,94,.22);
      transition: transform .12s ease, filter .2s ease;
    }
    .btn:hover{ filter: brightness(1.06); transform: translateY(-1px); }
    .btn:active{ transform: translateY(1px); }

    .ripple{
      position:absolute;
      border-radius: 999px;
      transform: translate(-50%, -50%);
      pointer-events:none;
      background: rgba(255,255,255,.45);
      mix-blend-mode: overlay;
      animation: ripple .55s ease-out forwards;
    }
    @keyframes ripple{
      from{ width:0; height:0; opacity:.9; }
      to{ width:520px; height:520px; opacity:0; }
    }

    .list{
      display:grid;
      gap: 12px;
    }

    .item{
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(2,6,23,.35);
      border-radius: 14px;
      padding: 12px;
    }

    .item-top{
      display:flex;
      justify-content: space-between;
      align-items: baseline;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 6px;
    }

    .who{
      font-weight: 800;
      font-size: 14px;
    }
    .role{
      color: var(--muted);
      font-size: 12.5px;
      font-weight: 600;
    }
    .time{
      color: rgba(229,231,235,.75);
      font-size: 12.5px;
    }

    .meta{
      color: rgba(229,231,235,.85);
      font-size: 13px;
      line-height: 1.5;
    }

    .pill{
      display:inline-block;
      padding: 6px 10px;
      border-radius: 999px;
      font-size: 12px;
      border: 1px solid rgba(255,255,255,.12);
      background: rgba(15,23,42,.45);
      color: rgba(229,231,235,.85);
      margin-top: 8px;
    }

    .empty{
      color: var(--muted);
      font-size: 13.5px;
      padding: 10px 0;
    }

    @media (max-width: 980px){
      .grid{ grid-template-columns: 1fr; }
    }

    @media (prefers-reduced-motion: reduce){
      .ripple{ display:none; }
      .card::before{ transition:none; }
    }
  </style>
</head>

<body>
  <div class="wrap">

    <div class="topbar">
      <div class="title">
        <h3>Daily Updates ({{ $date }})</h3>
        <p>Updates made by personnel + activities logged for the day.</p>
      </div>

      <div class="links">
        <a class="link" href="/dashboard">Dashboard</a>
        <a class="link" href="/activities/create">Create Activity</a>
        <a class="link" href="/activities/reports">Reports</a>
      </div>
    </div>

    <div class="grid">
      <!-- LEFT: Updates -->
      <section class="card glow-card" id="updatesCard">
        <div class="content">
          <div class="card-head">
            <h4>Updates Timeline</h4>

            <form class="filter" method="GET" action="/activities/daily-updates">
              <input type="date" name="date" value="{{ $date }}">
              <button class="btn" id="viewBtn" type="submit">View</button>
            </form>
          </div>

          <div class="list">
            @forelse ($updates as $u)
              <div class="item">
                <div class="item-top">
                  <div>
                    <span class="who">{{ $u->updated_by_name }}</span>
                    <span class="role">({{ $u->updated_by_role }})</span>
                  </div>
                  <span class="time">
                    {{ \Carbon\Carbon::parse($u->updated_at)->format('H:i') }}
                  </span>
                </div>

                <div class="meta">
                  Activity: <strong>{{ $u->activity->title }}</strong><br>
                  Status: {{ $u->old_status ?? '-' }} → <strong>{{ $u->new_status }}</strong><br>
                  Remark: {{ $u->old_remark ?? '-' }} → <strong>{{ $u->new_remark ?? '-' }}</strong>
                </div>

                <span class="pill">Update logged</span>
              </div>
            @empty
              <div class="empty">No updates for this date.</div>
            @endforelse
          </div>
        </div>
      </section>

      <!-- RIGHT: Activities logged -->
      <aside class="card glow-card" id="activitiesCard">
        <div class="content">
          <div class="card-head">
            <h4>Activities Logged</h4>
            <span class="pill">{{ $date }}</span>
          </div>

          {{-- IMPORTANT:
               This expects you to pass $activities from the controller
               (see note below) --}}
          <div class="list">
            @isset($activities)
              @forelse ($activities as $a)
                <div class="item">
                  <div class="item-top">
                    <div>
                      <span class="who">{{ $a->member_name }}</span>
                      <span class="role">({{ $a->status ?? 'pending' }})</span>
                    </div>
                    <span class="time">{{ \Carbon\Carbon::parse($a->created_at)->format('H:i') }}</span>
                  </div>

                  <div class="meta">
                    <strong>{{ $a->title }}</strong><br>
                    SMS: {{ $a->sms_count ?? '-' }} | Logs: {{ $a->sms_account_from_logs ?? '-' }}
                  </div>

                  <span class="pill">Created activity</span>
                </div>
              @empty
                <div class="empty">No activities were logged on this date.</div>
              @endforelse
            @else
              <div class="empty">
                Activities panel is ready — your controller just needs to pass <code>$activities</code>.
              </div>
            @endisset
          </div>
        </div>
      </aside>
    </div>

  </div>

  <script>
    // Mouse-follow glow for both cards
    function attachGlow(card){
      function setGlow(x, y){
        const r = card.getBoundingClientRect();
        const mx = ((x - r.left) / r.width) * 100;
        const my = ((y - r.top) / r.height) * 100;
        card.style.setProperty('--mx', mx + '%');
        card.style.setProperty('--my', my + '%');
      }
      card.addEventListener('mousemove', (e) => setGlow(e.clientX, e.clientY));
      card.addEventListener('touchmove', (e) => {
        if (!e.touches || !e.touches[0]) return;
        setGlow(e.touches[0].clientX, e.touches[0].clientY);
      }, { passive: true });
    }

    attachGlow(document.getElementById('updatesCard'));
    attachGlow(document.getElementById('activitiesCard'));

    // Button ripple
    const btn = document.getElementById('viewBtn');
    btn.addEventListener('click', (e) => {
      const rect = btn.getBoundingClientRect();
      const ripple = document.createElement('span');
      ripple.className = 'ripple';
      ripple.style.left = (e.clientX - rect.left) + 'px';
      ripple.style.top  = (e.clientY - rect.top) + 'px';
      btn.appendChild(ripple);
      ripple.addEventListener('animationend', () => ripple.remove());
    });
  </script>
</body>
</html>
