<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Meeting Room Schedule</title>
  <style>
    body { font-family: sans-serif; margin: 2rem; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ddd; padding: 0.5rem; vertical-align: top; }
    button { padding: 0.5rem 1rem; }
    .status { color: green; margin-bottom: 1rem; }
  </style>
</head>
<body>
  <h1>Meeting Room Booking Optimizer</h1>

  @if(session('status'))
    <div class="status">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('schedule.optimize') }}">
    @csrf
    <button type="submit">Optimize Meetings</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>Room</th>
        <th>Assigned Meetings</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rooms as $room)
        <tr>
          <td>{{ $room->name }}</td>
          <td>
            @if($room->meetings->isEmpty())
              <em>No meetings</em>
            @else
              <ul>
                @foreach($room->meetings as $m)
                  <li>
                    {{ $m->title }}
                    ({{ \Carbon\Carbon::parse($m->start_time)->format('H:i') }}
                     – 
                     {{ \Carbon\Carbon::parse($m->end_time)->format('H:i') }})
                  </li>
                @endforeach
              </ul>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
