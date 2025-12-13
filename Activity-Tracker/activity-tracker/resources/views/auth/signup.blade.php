<h2>Sign Up</h2>

@if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
@endif

<form method="POST" action="{{ route('signup.store') }}">
  @csrf

  <div>
    <label>Name</label><br>
    <input name="name" value="{{ old('name') }}" required>
  </div>

  <br>

  <div>
    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required>
  </div>

  <br>

  <div>
    <label>Password</label><br>
    <input type="password" name="password" required>
  </div>

  <br>

  <div>
    <label>Confirm Password</label><br>
    <input type="password" name="password_confirmation" required>
  </div>

  <br>

  <button type="submit">Create Account</button>
</form>

<p style="margin-top: 12px;">
  Already have an account? <a href="{{ route('login') }}">Login</a>
</p>
