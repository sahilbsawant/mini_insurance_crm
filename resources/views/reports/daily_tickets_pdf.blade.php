<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Tickets Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>

<body>

<h2>Daily Tickets Report ({{ today()->format('d M Y') }})</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Client</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Created</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tickets as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->subject }}</td>
            <td>{{ $t->client->name }}</td>
            <td>{{ $t->assignee?->name ?? '-' }}</td>
            <td>{{ $t->status }}</td>
            <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
