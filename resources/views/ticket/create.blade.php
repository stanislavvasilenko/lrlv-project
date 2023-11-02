@extends('layouts.main')
@section('content')
<div class="">
  <form method="POST" action="{{ route('ticket.store') }}">
    @csrf
    <div class="form-group">
      <label for="ticket_number" class="form-label">Ticket number</label>
      <input type="text" class="form-control" name="ticket_number" id="title" aria-describedby="title">
    </div>
    <div class="form-group">
      <label for="ticket_status" class="form-label">Ticket status</label>
      <select class="form-select" name="ticket_status" id="">
        <option value="0">Closed</option>
        <option value="1">Opened</option>
      </select>
    </div>
    <div class="form-group">
      <label for="agent_type" class="form-label">Agent type</label>
      <input type="text" class="form-control" name="agent_type" id="agent_type" aria-describedby="title">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection