<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AutoEscalateTicketJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        try {


            $tickets = Ticket::where('status', 'open')->get();

            foreach ($tickets as $ticket) {
                if (!$ticket->escalate_at) {
                    continue;
                }

                if (Carbon::parse($ticket->escalate_at)->gt(now())) {
                    continue;  // time not reached yet
                }


                $currentUser = User::find($ticket->assigned_to);
                if (!$currentUser) {
                    continue;
                }

                $currentLevel = $currentUser->role->level;
                $nextLevel    = $currentLevel + 1;

                $nextUser = User::whereHas('role', function ($q) use ($nextLevel) {
                    $q->where('level', $nextLevel);
                })->first();

                if (!$nextUser) {

                    continue;
                }

                $ticket->status = "escalated";
                $ticket->escalated_from = $ticket->assigned_to;
                $ticket->save();

                $newTicket = Ticket::create([
                    'subject'       => $ticket->subject,
                    'description'   => $ticket->description,
                    'client_id'     => $ticket->client_id,
                    'created_by'    => $ticket->created_by,
                    'assigned_to'   => $nextUser->id,
                    'status'        => 'open',
                    'escalate_at'   => now()->addMinutes(5),
                    'escalated_from' => $ticket->assigned_to,
                    'escalated_to'   => $nextUser->id,
                ]);
            }
        } catch (\Exception $e) {

            dump($e->getMessage());
        }
    }
}
