<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Policy;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DailyTicketsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivePoliciesExport;

class ReportController extends Controller
{
    
    public function dailyTicketsPDF()
    {
        $tickets = Ticket::whereDate('created_at', today())->get();
        $pdf = PDF::loadView('reports.daily_tickets_pdf', compact('tickets'));
        return $pdf->download('daily_tickets.pdf');
    }

    // Daily tickets Excel
    public function dailyTicketsExcel()
    {
        $tickets = Ticket::whereDate('created_at', today())->get();
        return Excel::download(new DailyTicketsExport($tickets), 'daily_tickets.xlsx');
    }

    
    public function activePoliciesPDF()
    {
        $policies = Policy::where('status', 'active')->get();

        $pdf = Pdf::loadView('reports.active_policies_pdf', compact('policies'));
        return $pdf->download('active_policies.pdf');
    }

    
    public function activePoliciesExcel()
    {
        $policies = Policy::where('status', 'active')->get();

        return Excel::download(new ActivePoliciesExport($policies), 'active_policies.xlsx');
    }
}
