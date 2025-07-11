<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>PD SYSTEM - Reports</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  {{-- Embed separate CSS for each view --}}
  @stack('styles')
</head>

<body>
  @yield('content')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Embed separate JS for each view --}}
  @stack('scripts')
</body>

</html>