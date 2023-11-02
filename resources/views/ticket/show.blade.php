@extends('layouts.main')
@section('content')
<div class="">
  <div class="">{{ $ticket->id }}. {{ $ticket->ticket_number }}</div>
  <div class="">Ticket status: {{ $ticket->ticket_status }}</div>
  <div class="">Agent type: {{ $ticket->agent_type }}</div>
</div>
<div class="">
  <a href="{{ route('ticket.edit', $ticket->id )}}">Edit</a>
</div>
<div class="">
  <form action="{{ route('ticket.destroy', $ticket->id )}}" method="post">
    @csrf
    @method('delete')
    <input type="submit" class="btn btn-danger" value="Delete">
  </form>
</div>
<div class="">
  <a href="{{ route('ticket.index') }}">Back</a>
</div>
@endsection