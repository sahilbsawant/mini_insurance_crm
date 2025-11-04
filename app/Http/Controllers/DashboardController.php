<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPolicies = Policy::count();
        $openTickets = Ticket::where('status', 'open')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();

        
        $weekLabels = [];
        $weekData = [];

        foreach (range(6, 0) as $day) {
            $date = now()->subDays($day)->format('d M');
            $count = Ticket::whereDate('updated_at', now()->subDays($day))
                ->where('status', 'closed')
                ->count();

            $weekLabels[] = $date;
            $weekData[] = $count;
        }

        return view('dashboard', compact(
            'totalPolicies',
            'openTickets',
            'closedTickets',
            'weekLabels',
            'weekData'
        ));
    }
}
