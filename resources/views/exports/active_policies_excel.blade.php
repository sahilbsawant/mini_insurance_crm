<table>
    <thead>
        <tr>
            <th>Client</th>
            <th>Policy Type</th>
            <th>Premium</th>
            <th>Renewal Date</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($policies as $p)
            <tr>
                <td>{{ $p->client->name }}</td>
                <td>{{ $p->policy_type }}</td>
                <td>{{ $p->premium }}</td>
                <td>{{ $p->renewal_date }}</td>
                <td>{{ ucfirst($p->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
