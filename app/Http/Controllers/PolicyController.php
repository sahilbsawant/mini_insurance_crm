<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function store(Request $request, Client $client)
{
    $validated = $request->validate([
        'policy_type' => 'required|string',
        'premium' => 'required|numeric',
        'renewal_date' => 'nullable|date',
        'status' => 'required|string'
    ]);

    $validated['client_id'] = $client->id;
    $validated['created_by'] = auth()->id();

    Policy::create($validated);

    return back()->with('success', 'Policy added successfully!');
}

}
