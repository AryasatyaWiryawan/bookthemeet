<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title','Meeting Optimizer')</title>
  <!-- Bootstrap 5 -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
          <a class="navbar-brand" href="{{ route('schedule.index') }}">📅 Optimizer</a>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('rooms.index') }}">Rooms</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('meetings.index') }}">Meetings</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('schedule.index') }}">Schedule</a></li>
          </ul>
        </div>
      </nav>
  <div class="container">
    @yield('content')
  </div>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
  </script>
</body>
</html>
