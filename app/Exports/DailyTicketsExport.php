<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DailyTicketsExport implements FromCollection, WithHeadings
{
    public $tickets;

    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    public function collection()
    {
        return $this->tickets->map(function ($t) {
            return [
                'ID'          => $t->id,
                'Subject'     => $t->subject,
                'Description' => $t->description,
                'Assigned To' => $t->assignee->name ?? 'N/A',
                'Status'      => $t->status,
                'Created At'  => $t->created_at->format('Y-m-d H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Subject',
            'Description',
            'Assigned To',
            'Status',
            'Created At'
        ];
    }
}
