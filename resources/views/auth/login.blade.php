<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PD SYSTEM - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
  <div class="login-wrapper d-flex justify-content-center align-items-center vh-100">
    <div class="login-box p-4 rounded-4 shadow">
      <h3 class="text-center mb-4 fw-bold">PD SYSTEM</h3>
      {{-- Show errors if any --}}
      @if ($errors->any())
      <div class="alert alert-danger text-center">
        {{ $errors->first() }}
      </div>
      @endif
      <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            <span class="input-group-text toggle-password" onclick="togglePassword()" style="cursor: pointer;">
              <i id="eye-icon" class="fa-solid fa-eye-slash"></i>
            </span>
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary px-4 py-2">Login</button>
        </div>
      </form>

      <div class="text-center mt-4 text-muted small">
        <select class="form-select form-select-sm w-auto mx-auto">
          <option selected>English (United States)</option>
          <option>Tiếng Việt</option>
        </select>
        <div class="mt-3">
          <a href="#">About</a> · <a href="#">Help Center</a> · <a href="#">Terms</a> · <a href="#">Privacy</a> · <a href="#">Cookie</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>