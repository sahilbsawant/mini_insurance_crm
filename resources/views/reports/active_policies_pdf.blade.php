<h2>Active Policies Report</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Client</th>
        <th>Type</th>
        <th>Premium</th>
        <th>Renewal</th>
        <th>Status</th>
    </tr>

    @foreach($policies as $p)
        <tr>
            <td>{{ $p->client->name }}</td>
            <td>{{ $p->policy_type }}</td>
            <td>{{ $p->premium }}</td>
            <td>{{ $p->renewal_date }}</td>
            <td>{{ $p->status }}</td>
        </tr>
    @endforeach
</table>
