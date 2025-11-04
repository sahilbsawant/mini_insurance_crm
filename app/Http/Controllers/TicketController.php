<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function store(Request $request, Client $client)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['client_id'] = $client->id;
        $validated['created_by'] = auth()->id();
        $validated['assigned_to'] = auth()->id();
        $validated['escalate_at'] = now();

        Ticket::create($validated);

        return back()->with('success', 'Ticket created successfully!');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }
}
