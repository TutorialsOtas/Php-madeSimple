<style>
  body{
    margin:0;
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
    background: #0b1020;
    color: #e5e7eb;
    min-height: 100vh;
    display: grid;
    place-items: center;
    padding: 24px;
    overflow: hidden;
  }

  .card{
    width: 100%;
    max-width: 520px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(15,23,42,.75);
    border-radius: 18px;
    padding: 28px 24px 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.55);

    animation: floaty 3.2s ease-in-out infinite;
    will-change: transform;
    position: relative;
  }

  .card.still{
    animation: none !important;
    transform: translate3d(0,0,0) !important;
  }

  @keyframes floaty{
    0%   { transform: translate3d(0px, 0px, 0); }
    25%  { transform: translate3d(10px, -8px, 0); }
    50%  { transform: translate3d(0px, -14px, 0); }
    75%  { transform: translate3d(-10px, -8px, 0); }
    100% { transform: translate3d(0px, 0px, 0); }
  }

  /* 🐍 Snake logo */
  .snake-logo{
    position: absolute;
    top: -46px;
    left: 50%;
    transform: translateX(-50%);
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #facc15, #22c55e);
    box-shadow:
      0 0 25px rgba(34,197,94,.45),
      0 10px 30px rgba(0,0,0,.6);
    display: grid;
    place-items: center;
    cursor: pointer;
    transition: transform .15s ease, box-shadow .2s ease;
  }

  .snake-logo:hover{
    transform: translateX(-50%) scale(1.08);
    box-shadow:
      0 0 35px rgba(34,197,94,.7),
      0 16px 40px rgba(0,0,0,.7);
  }

  .snake-logo svg{
    width: 28px;
    height: 28px;
    fill: #0b1020;
  }

  h2{
    margin: 18px 0 10px;
    font-size: 26px;
    letter-spacing: -.02em;
    text-align: center;
  }

  .sub{
    color: rgba(229,231,235,.7);
    font-size: 14px;
    margin: 0 0 20px;
    line-height: 1.5;
    text-align: center;
  }

  ul{
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    gap: 12px;
  }

  a{
    display: block;
    padding: 14px 16px;
    border-radius: 14px;
    text-decoration: none;
    color: #0b1020;
    font-weight: 800;
    background: linear-gradient(135deg, #facc15, #22c55e);
    box-shadow: 0 14px 35px rgba(34,197,94,.25);
    transition: transform .12s ease, filter .2s ease;
    text-align: center;
  }

  a:hover{
    filter: brightness(1.06);
    transform: translateY(-1px);
  }

  a:active{
    transform: translateY(1px);
  }

  @media (prefers-reduced-motion: reduce){
    .card{ animation: none !important; }
  }
</style>

<div class="card" id="dashCard">

  <!-- 🐍 CLICKABLE SNAKE LOGO -->
  <a href="/signup" class="snake-logo" title="Go to Sign Up">
    <svg viewBox="0 0 24 24">
      <!-- simple snake glyph -->
      <path d="M12 2c-4.4 0-8 3.6-8 8 0 2.6 1.3 4.9 3.4 6.3-.3.4-.4.8-.4 1.2 0 1.4 1.1 2.5 2.5 2.5.8 0 1.6-.4 2-.9.5.5 1.2.9 2 .9 1.4 0 2.5-1.1 2.5-2.5 0-.4-.1-.8-.4-1.2C18.7 14.9 20 12.6 20 10c0-4.4-3.6-8-8-8zm-2 7a1 1 0 110-2 1 1 0 010 2zm4 0a1 1 0 110-2 1 1 0 010 2z"/>
    </svg>
  </a>

  <h2>Dashboard</h2>
  <p class="sub">Choose what you want to do next.</p>

  <ul>
    <li><a href="/activities/create">Create Activity</a></li>
    <li><a href="/activities/daily-updates">Daily Updates</a></li>
    <li><a href="/activities/reports">Reports</a></li>
  </ul>
</div>

<script>
  const card = document.getElementById('dashCard');
  document.querySelectorAll('#dashCard a').forEach(link => {
    link.addEventListener('click', () => {
      card.classList.add('still');
    });
  });
</script>
