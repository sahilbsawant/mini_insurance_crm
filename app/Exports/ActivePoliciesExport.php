<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ActivePoliciesExport implements FromView
{
    public $policies;

    public function __construct($policies)
    {
        $this->policies = $policies;
    }

    public function view(): View
    {
        return view('exports.active_policies_excel', [
            'policies' => $this->policies,
        ]);
    }
}
