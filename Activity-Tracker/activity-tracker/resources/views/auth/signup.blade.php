<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign Up</title>

  <style>
    :root{
      --bg1:#0b1020;
      --bg2:#0f1b2d;
      --card:#0f172a;
      --text:#e5e7eb;
      --muted:#9ca3af;
      --line:rgba(255,255,255,.12);

      --purple:#7c3aed;
      --green:#22c55e;
      --yellow:#facc15;

      --shadow-3d:
        0 30px 80px rgba(0,0,0,.65),
        0 0 0 1px rgba(255,255,255,.08);

      --radius:18px;
    }

    *{ box-sizing:border-box; }

    body{
      margin:0;
      min-height:100vh;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
      color:var(--text);
      background:
        radial-gradient(700px 500px at 15% 10%, rgba(250,204,21,.25), transparent 60%),
        radial-gradient(700px 500px at 90% 20%, rgba(34,197,94,.25), transparent 55%),
        radial-gradient(900px 650px at 60% 90%, rgba(124,58,237,.25), transparent 60%),
        linear-gradient(180deg, var(--bg1), var(--bg2));
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
    }

    .wrap{
      width:100%;
      max-width:980px;
      display:grid;
      grid-template-columns:1.1fr .9fr;
      gap:22px;
    }

    /* LEFT PANEL */
    .hero{
      padding:30px;
      border-radius:var(--radius);
      border:1px solid var(--line);
      background:rgba(15,23,42,.4);
      backdrop-filter:blur(12px);
      box-shadow:var(--shadow-3d);
    }

    .hero h1{
      font-size:34px;
      margin-bottom:10px;
      background:linear-gradient(135deg, var(--yellow), var(--green));
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
    }

    .hero p{
      color:var(--muted);
      line-height:1.6;
    }

    .badges{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      margin-top:18px;
    }

    .badge{
      padding:10px 14px;
      border-radius:999px;
      border:1px solid var(--line);
      background:rgba(2,6,23,.5);
      font-size:13px;
    }

    /* CARD */
    .card{
      padding:28px;
      border-radius:var(--radius);
      border:1px solid var(--line);
      background:rgba(15,23,42,.75);
      backdrop-filter:blur(16px);
      box-shadow:var(--shadow-3d);
      transform:translateY(0) perspective(1000px);
      transition:transform .35s ease, box-shadow .35s ease;
    }

    .card:hover{
      transform:translateY(-6px) perspective(1000px) rotateX(1deg);
      box-shadow:
        0 40px 100px rgba(0,0,0,.75),
        0 0 40px rgba(250,204,21,.25),
        0 0 60px rgba(34,197,94,.25);
    }

    .card h2{
      font-size:22px;
      margin-bottom:6px;
    }

    .sub{
      color:var(--muted);
      font-size:14px;
      margin-bottom:18px;
    }

    .errors{
      background:rgba(239,68,68,.12);
      border:1px solid rgba(239,68,68,.4);
      padding:12px;
      border-radius:12px;
      margin-bottom:14px;
      font-size:13px;
    }

    form{
      display:flex;
      flex-direction:column;
      gap:12px;
    }

    label{
      font-size:13px;
      color:#d1d5db;
    }

    .input{
      padding:12px;
      border-radius:12px;
      border:1px solid rgba(255,255,255,.15);
      background:rgba(2,6,23,.55);
      color:white;
      transition:.2s ease;
    }

    .input:focus{
      outline:none;
      border-color:var(--green);
      box-shadow:
        0 0 0 3px rgba(34,197,94,.25),
        0 0 12px rgba(250,204,21,.35);
    }

    .row{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:12px;
    }

    .btn{
      margin-top:8px;
      padding:14px;
      border-radius:14px;
      border:none;
      font-weight:700;
      color:#0b1020;
      cursor:pointer;
      background:linear-gradient(135deg, var(--yellow), var(--green));
      box-shadow:
        0 15px 40px rgba(34,197,94,.45),
        inset 0 0 0 1px rgba(255,255,255,.4);
      transition:.2s ease;
    }

    .btn:hover{
      filter:brightness(1.08);
      transform:translateY(-1px);
    }

    .foot{
      margin-top:14px;
      text-align:center;
      font-size:13px;
      color:var(--muted);
    }

    .foot a{
      color:var(--yellow);
      text-decoration:none;
      font-weight:600;
    }

    /* MOBILE */
    @media (max-width:900px){
      .wrap{ grid-template-columns:1fr; max-width:560px; }
    }

    @media (max-width:420px){
      .row{ grid-template-columns:1fr; }
    }
  </style>
</head>

<body>
  <div class="wrap">
    <section class="hero">
      <h1>Activity Tracker</h1>
      <p>
        Track daily activities, handovers, and updates with clarity.
        Built for support teams who value accountability.
      </p>

      <div class="badges">
        <span class="badge">✔ Status Tracking</span>
        <span class="badge">📊 Reports</span>
        <span class="badge">🔒 Secure Access</span>
      </div>
    </section>

    <main class="card">
      <h2>Create Account</h2>
      <p class="sub">Enter your details to continue</p>

      @if ($errors->any())
        <div class="errors">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('signup.store') }}">
        @csrf

        <div>
          <label>Name</label>
          <input class="input" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
          <label>Email</label>
          <input class="input" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="row">
          <div>
            <label>Password</label>
            <input class="input" type="password" name="password" required>
          </div>

          <div>
            <label>Confirm Password</label>
            <input class="input" type="password" name="password_confirmation" required>
          </div>
        </div>

        <button class="btn" type="submit">Create Account</button>
      </form>
    </main>
  </div>
</body>
</html>
