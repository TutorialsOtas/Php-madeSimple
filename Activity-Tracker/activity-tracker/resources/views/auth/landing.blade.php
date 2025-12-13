<h2>Welcome</h2>

<div style="display:flex; gap:40px; align-items:flex-start;">

  {{-- SIGN UP --}}
  <div>
    <h3>Sign Up</h3>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <input name="name" placeholder="Name" required><br><br>
      <input name="email" type="email" placeholder="Email" required><br><br>
      <input name="password" type="password" placeholder="Password" required><br><br>
      <input name="password_confirmation" type="password" placeholder="Confirm Password" required><br><br>

      <button type="submit">Create Account</button>
    </form>
  </div>

  {{-- LOGIN --}}
  <div>
    <h3>Login</h3>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <input name="email" type="email" placeholder="Email" required><br><br>
      <input name="password" type="password" placeholder="Password" required><br><br>

      <button type="submit">Login</button>
    </form>
  </div>

</div>
