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
    padding: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.55);

    /* floating animation */
    animation: floaty 3.2s ease-in-out infinite;
    will-change: transform;
  }

  /* Stops motion once selection is made */
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

  h2{
    margin: 0 0 14px;
    font-size: 26px;
    letter-spacing: -.02em;
  }

  .sub{
    color: rgba(229,231,235,.7);
    font-size: 14px;
    margin: 0 0 18px;
    line-height: 1.5;
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

  /* Accessibility: if user prefers reduced motion, don't animate */
  @media (prefers-reduced-motion: reduce){
    .card{ animation: none !important; }
  }
</style>

<div class="card" id="dashCard">
  <h2>Dashboard</h2>
  <p class="sub">Choose what you want to do next.</p>

  <ul>
    <li><a href="/activities/create">Create Activity</a></li>
    <li><a href="/activities/daily-updates">Daily Updates</a></li>
    <li><a href="/activities/reports">Reports</a></li>
  </ul>
</div>

<script>
  // Stop animation once any option is selected (clicked)
  const card = document.getElementById('dashCard');
  document.querySelectorAll('#dashCard a').forEach(link => {
    link.addEventListener('click', () => {
      card.classList.add('still');
    });
  });
</script>
