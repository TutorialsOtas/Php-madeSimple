<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Activity</title>

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
      --shadow: 0 26px 80px rgba(0,0,0,.65);
      --radius: 18px;
    }

    *{ box-sizing: border-box; }

    body{
      margin:0;
      min-height:100vh;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
      color: var(--text);
      background:
        radial-gradient(800px 520px at 15% 10%, rgba(250,204,21,.14), transparent 60%),
        radial-gradient(750px 520px at 85% 20%, rgba(34,197,94,.16), transparent 58%),
        radial-gradient(900px 650px at 55% 95%, rgba(96,165,250,.12), transparent 60%),
        linear-gradient(180deg, var(--bg1), var(--bg2));
      display:grid;
      place-items:center;
      padding: 24px;
    }

    .wrap{
      width: 100%;
      max-width: 720px;
    }

    .card{
      position: relative;
      border-radius: var(--radius);
      border: 1px solid var(--line);
      background: var(--card);
      backdrop-filter: blur(16px);
      box-shadow: var(--shadow);
      overflow: hidden;
      padding: 22px;
    }

    /* Mouse-follow glow layer */
    .card::before{
      content:"";
      position:absolute;
      inset:-2px;
      background:
        radial-gradient(600px 300px at var(--mx, 50%) var(--my, 40%),
          rgba(250,204,21,.22),
          rgba(34,197,94,.16) 35%,
          transparent 65%);
      filter: blur(18px);
      opacity: .85;
      transition: opacity .25s ease;
      z-index: 0;
      pointer-events: none;
    }

    /* Subtle border shine */
    .card::after{
      content:"";
      position:absolute;
      inset:0;
      border-radius: var(--radius);
      background: linear-gradient(135deg, rgba(250,204,21,.10), rgba(34,197,94,.08), rgba(255,255,255,.03));
      opacity: .35;
      pointer-events:none;
      z-index: 0;
    }

    .content{
      position: relative;
      z-index: 1;
    }

    h2{
      margin: 0 0 6px;
      font-size: 24px;
      letter-spacing: -.02em;
      background: linear-gradient(135deg, var(--yellow), var(--green));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .sub{
      margin: 0 0 18px;
      color: var(--muted);
      font-size: 14px;
      line-height: 1.5;
    }

    form{
      display: grid;
      gap: 12px;
    }

    .row{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    label{
      font-size: 13px;
      color: rgba(229,231,235,.85);
      display:block;
      margin: 0 0 6px;
    }

    .field{
      display:flex;
      flex-direction:column;
    }

    input, textarea{
      width: 100%;
      padding: 12px 12px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.14);
      background: rgba(2,6,23,.55);
      color: var(--text);
      outline: none;
      transition: .18s ease;
    }

    textarea{
      min-height: 110px;
      resize: vertical;
    }

    input::placeholder, textarea::placeholder{
      color: rgba(229,231,235,.42);
    }

    input:focus, textarea:focus{
      border-color: rgba(34,197,94,.70);
      box-shadow: 0 0 0 4px rgba(34,197,94,.18);
      background: rgba(2,6,23,.62);
    }

    .btn{
      position: relative;
      overflow: hidden;
      border: none;
      border-radius: 14px;
      padding: 14px 16px;
      cursor: pointer;
      font-weight: 900;
      color: #0b1020;
      background: linear-gradient(135deg, var(--yellow), var(--green));
      box-shadow: 0 18px 55px rgba(34,197,94,.28);
      transition: transform .12s ease, filter .2s ease;
    }

    /* Hover micro pulse */
    .btn:hover{
      filter: brightness(1.06);
      transform: translateY(-1px);
      animation: btnPulse .9s ease-in-out infinite alternate;
    }
    @keyframes btnPulse{
      from { box-shadow: 0 18px 55px rgba(34,197,94,.28); }
      to   { box-shadow: 0 22px 70px rgba(250,204,21,.22), 0 18px 60px rgba(34,197,94,.34); }
    }

    .btn:active{
      transform: translateY(1px);
      animation: none;
    }

    /* Ripple element */
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
      from{ width: 0; height: 0; opacity: .9; }
      to{ width: 520px; height: 520px; opacity: 0; }
    }

    .top-actions{
      display:flex;
      gap: 10px;
      justify-content: space-between;
      align-items:center;
      margin-bottom: 10px;
    }

    .link{
      color: rgba(229,231,235,.8);
      text-decoration: none;
      font-size: 13px;
      border: 1px solid rgba(255,255,255,.12);
      padding: 8px 10px;
      border-radius: 999px;
      background: rgba(2,6,23,.35);
    }
    .link:hover{ color: white; }

    @media (max-width: 640px){
      .row{ grid-template-columns: 1fr; }
      .card{ padding: 18px; }
    }

    @media (prefers-reduced-motion: reduce){
      .btn:hover{ animation: none; }
      .ripple{ display:none; }
      .card::before{ transition:none; }
    }

    .toast{
  position: fixed;
  top: 18px;
  right: 18px;
  z-index: 9999;
  display: flex;
  gap: 10px;
  align-items: center;

  padding: 12px 14px;
  border-radius: 16px;
  border: 1px solid rgba(255,255,255,.14);
  background: rgba(2,6,23,.85);
  color: #e5e7eb;
  box-shadow: 0 20px 60px rgba(0,0,0,.55);

  transform: translateX(120%);
  opacity: 0;
}

.toast-show{
  animation: toastIn .35s ease-out forwards;
}

@keyframes toastIn{
  to { transform: translateX(0); opacity: 1; }
}

.toast-icon{
  width: 34px;
  height: 34px;
  border-radius: 12px;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, #facc15, #22c55e);
  color: #0b1020;
  font-weight: 900;
}

.toast-text strong{
  display:block;
  font-size: 13px;
  line-height: 1.1;
}
.toast-text div{
  font-size: 12.5px;
  color: rgba(229,231,235,.75);
}

  </style>
</head>

    @if(session('success'))
  <div class="toast toast-show" id="toast">
    <span class="toast-icon">✅</span>
    <div class="toast-text">
      <strong>Saved</strong>
      <div>{{ session('success') }}</div>
    </div>
  </div>
@endif

<body>
  <div class="wrap">
    <div class="card" id="glowCard">
      <div class="content">
        <div class="top-actions">
          <a class="link" href="/dashboard">← Dashboard</a>
          <a class="link" href="/activities/daily-updates">Daily Updates</a>
        </div>

        <h2>Create Activity</h2>
        <p class="sub">Add an activity for the support team. Keep it clear and measurable.</p>

        <form action="/activities" method="POST" novalidate>
          @csrf

          <div class="row">
            <div class="field">
              <label for="member_name">Member name</label>
              <input id="member_name" name="member_name" placeholder="e.g. Ama Mensah" value="{{ old('member_name') }}" required>
            </div>

            <div class="field">
              <label for="activity_date">Activity date</label>
              <input id="activity_date" name="activity_date" type="date" value="{{ old('activity_date') }}" required>
            </div>
          </div>

          <div class="field">
            <label for="title">Activity title</label>
            <input id="title" name="title" placeholder="e.g. Daily SMS count vs logs" value="{{ old('title') }}" required>
          </div>

          <div class="field">
            <label for="details">Details</label>
            <textarea id="details" name="details" placeholder="Write short details...">{{ old('details') }}</textarea>
          </div>

          <div class="row">
            <div class="field">
              <label for="sms_count">Daily SMS count</label>
              <input id="sms_count" name="sms_count" type="number" placeholder="e.g. 1200" value="{{ old('sms_count') }}">
            </div>

            <div class="field">
              <label for="sms_account_from_logs">SMS from logs</label>
              <input id="sms_account_from_logs" name="sms_account_from_logs" type="number" placeholder="e.g. 1188" value="{{ old('sms_account_from_logs') }}">
            </div>
          </div>

          <button class="btn" id="saveBtn" type="submit">Save Activity</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Soft glow follows mouse
    const card = document.getElementById('glowCard');

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

    // Button ripple effect
    const btn = document.getElementById('saveBtn');
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
