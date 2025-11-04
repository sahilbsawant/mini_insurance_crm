<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Policy;

class AdminDashboardController extends Controller
{
    public function index()
    {

        $totalPolicies = Policy::count(); 
        $openTickets   = Ticket::where('status', 'open')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();


        $users = User::withCount('assignedTickets')->get();

        $userNames = $users->pluck('name');
        $userTicketCounts = $users->pluck('assigned_tickets_count');

        return view('admin.dashboard', compact(
            'totalPolicies',
            'openTickets',
            'closedTickets',
            'userNames',
            'userTicketCounts'
        ));
    }
}
