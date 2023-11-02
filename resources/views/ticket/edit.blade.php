@extends('layouts.main')
@section('content')
<div class="">
   <form method="POST" action="{{ route('ticket.update', $ticket->id) }}">
      @csrf
      @method('patch')
      <div class="form-group">
         <label for="ticket_number" class="form-label">Ticket number</label>
         <input type="text" class="form-control" name="ticket_number" id="title" aria-describedby="title" value="{{ $ticket->ticket_number }}">
      </div>
      <div class="form-group">
         <label for="ticket_status" class="form-label">Ticket status</label>
         <select class="form-select" name="ticket_status" id="">
            @foreach($statuses as $status_id => $status_value)
               <option value="{{ $status_id }}" {{ $ticket->ticket_status == $status_id ? 'selected' : '' }}>{{ $status_value }}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <label for="agent_type" class="form-label">Agent type</label>
         <input type="text" class="form-control" name="agent_type" id="agent_type" aria-describedby="title" value="{{ $ticket->agent_type }}">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
   </form>
</div>
@endsection