<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketController extends Controller
{
   public function index() {
      $tickets = Ticket::all();

      return view('ticket.index', compact('tickets'));
   }

   public function create() {
      return view('ticket.create');
   }

   public function store() {
      $data = request()->validate([
         'ticket_number' => 'string',
         'ticket_status' => 'boolean',
         'agent_type' => 'integer',
      ]);

      Ticket::create($data);

      return redirect()->route('ticket.index');
   }

   public function show(Ticket $ticket) {
      return view('ticket.show', compact('ticket'));
   }

   public function edit(Ticket $ticket) {
      $statuses = [
         0 => 'Closed',
         1 => 'Opened'
      ];
      return view('ticket.edit', compact('ticket', 'statuses'));
   }

   public function update(Ticket $ticket) {
      $data = request()->validate([
         'ticket_number' => 'string',
         'ticket_status' => 'boolean',
         'agent_type' => 'integer',
      ]);

      $ticket->update($data);

      return redirect()->route('ticket.show', $ticket->id);
   }

   public function destroy(Ticket $ticket) {
      $ticket->delete();
      return redirect()->route('ticket.index');
   }
}
